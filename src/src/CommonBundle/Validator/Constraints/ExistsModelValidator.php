<?php

namespace App\CommonBundle\Validator\Constraints;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Это модифицированный валидатор {@see \Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator}.
 *
 * Отличие в том, что у симфоняшного валидатора проверяемый объект обязан быть сущностью. Для этого валидатора наоборот:
 * проверяемый объект не обязан быть сущностью, но требует обязательного указание класса сущности. Таким образом мы
 * можем проверить наличие сущности, данные о которой содержаться в объекте-команде.
 */
class ExistsModelValidator extends ConstraintValidator
{
    /**
     * @var ManagerRegistry
     */
    private $registry;

    /**
     * @var PropertyAccessorInterface
     */
    private $propertyAccessor;

    /**
     * Сonstructor.
     *
     * @param ManagerRegistry           $registry
     * @param PropertyAccessorInterface $propertyAccessor
     */
    public function __construct(ManagerRegistry $registry, PropertyAccessorInterface $propertyAccessor)
    {
        $this->registry = $registry;
        $this->propertyAccessor = $propertyAccessor;
    }

    /**
     * @param object|null $model
     * @param Constraint  $constraint
     *
     * @throws UnexpectedTypeException
     * @throws ConstraintDefinitionException
     */
    public function validate($model, Constraint $constraint)
    {
        if (!$constraint instanceof ExistsModel) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__ . '\ExistsModel');
        }

        if (!is_array($constraint->fields) && !is_string($constraint->fields)) {
            throw new UnexpectedTypeException($constraint->fields, 'array');
        }

        if (null !== $constraint->errorPath && !is_string($constraint->errorPath)) {
            throw new UnexpectedTypeException($constraint->errorPath, 'string or null');
        }

        $fields = (array) $constraint->fields;

        if (0 === count($fields)) {
            throw new ConstraintDefinitionException('At least one field has to be specified.');
        }

        if (null === $model) {
            return;
        }

        if ($constraint->em) {
            $em = $this->registry->getManager($constraint->em);

            if (!$em) {
                throw new ConstraintDefinitionException(sprintf('Object manager "%s" does not exist.', $constraint->em));
            }
        } else {
            $em = $this->registry->getManagerForClass($constraint->entityClass);

            if (!$em) {
                throw new ConstraintDefinitionException(sprintf('Unable to find the object manager associated with an entity of class "%s".', $constraint->entityClass));
            }
        }

        $classMetadata = $em->getClassMetadata($constraint->entityClass);
        /* @var $classMetadata ClassMetadata|ClassMetadataInfo */

        $criteria = [];
        $hasNullValue = false;

        foreach ($fields as $fieldName) {
            if (!$classMetadata->hasField($fieldName) && !$classMetadata->hasAssociation($fieldName)) {
                throw new ConstraintDefinitionException(sprintf('The field "%s" is not mapped by Doctrine, so it cannot be validated for existing.', $fieldName));
            }

            $fieldValue = $this->propertyAccessor->getValue(
                $model,
                array_key_exists($fieldName, $constraint->propertyToFieldMap)
                    ?
                    $constraint->propertyToFieldMap[$fieldName]
                    :
                    $fieldName
            );

            if (null === $fieldValue) {
                $hasNullValue = true;
            }

            if ($constraint->ignoreNull && null === $fieldValue) {
                continue;
            }

            $criteria[$fieldName] = $fieldValue;

            if (null !== $criteria[$fieldName] && $classMetadata->hasAssociation($fieldName)) {
                /* Ensure the Proxy is initialized before using reflection to
                 * read its identifiers. This is necessary because the wrapped
                 * getter methods in the Proxy are being bypassed.
                 */
                $em->initializeObject($criteria[$fieldName]);
            }
        }//end foreach

        // validation doesn't fail if one of the fields is null and if null values should be ignored
        if ($hasNullValue && $constraint->ignoreNull) {
            return;
        }

        // skip validation if there are no criteria (this can happen when the
        // "ignoreNull" option is enabled and fields to be checked are null
        if (empty($criteria)) {
            return;
        }

        $repository = $em->getRepository($constraint->entityClass);

        $result = $repository->{$constraint->repositoryMethod}($criteria);

        if ($result instanceof \IteratorAggregate) {
            $result = $result->getIterator();
        }

        /* If the result is a MongoCursor, it must be advanced to the first
         * element. Rewinding should have no ill effect if $result is another
         * iterator implementation.
         */
        if ($result instanceof \Iterator) {
            $result->rewind();
        } elseif (is_array($result)) {
            reset($result);
        }

        /* If model matched the query criteria, the criteria is exists. */
        if (0 < count($result)) {
            return;
        }

        $errorPath = null !== $constraint->errorPath ? $constraint->errorPath : $fields[0];
        $invalidValue = isset($criteria[$errorPath]) ? $criteria[$errorPath] : $criteria[$fields[0]];

        $this->context->buildViolation($constraint->message)
            ->atPath($errorPath)
            ->setParameter('{{ value }}', $this->formatWithIdentifiers($em, $classMetadata, $invalidValue))
            ->setInvalidValue($invalidValue)
            ->setCause($result)
            ->addViolation()
        ;
    }

    /**
     * @param ObjectManager $em
     * @param ClassMetadata $class
     * @param $value
     *
     * @return string
     */
    private function formatWithIdentifiers(ObjectManager $em, ClassMetadata $class, $value)
    {
        if (!is_object($value) || $value instanceof \DateTimeInterface) {
            return $this->formatValue($value, self::PRETTY_DATE);
        }

        if ($class->getName() !== $idClass = get_class($value)) {
            // non unique value might be a composite PK that consists of other entity objects
            if ($em->getMetadataFactory()->hasMetadataFor($idClass)) {
                $identifiers = $em->getClassMetadata($idClass)->getIdentifierValues($value);
            } else {
                // this case might happen if the non unique column has a custom doctrine type and its value is an object
                // in which case we cannot get any identifiers for it
                $identifiers = [];
            }
        } else {
            $identifiers = $class->getIdentifierValues($value);
        }

        if (!$identifiers) {
            return sprintf('object("%s")', $idClass);
        }

        array_walk(
            $identifiers,
            function (&$id, $field) {
                if (!is_object($id) || $id instanceof \DateTimeInterface) {
                    $idAsString = $this->formatValue($id, self::PRETTY_DATE);
                } else {
                    $idAsString = sprintf('object("%s")', get_class($id));
                }

                $id = sprintf('%s => %s', $field, $idAsString);
            }
        );

        return sprintf('object("%s") identified by (%s)', $idClass, implode(', ', $identifiers));
    }
}
