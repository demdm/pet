<?php

namespace App\CommonBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint for the Unique Entity validator.
 *
 * @Annotation
 * @Target({"CLASS", "ANNOTATION"})
 */
class UniqueModel extends Constraint
{
    public $message = 'This value is already used.';

    public $em = null;

    public $entityClass = null;

    public $repositoryMethod = 'findBy';

    public $fields = [];

    public $errorPath = null;

    public $ignoreNull = true;

    public $propertyToFieldMap = [];

    public $excludedIdField = null;

    /**
     * {@inheritdoc}
     */
    public function getRequiredOptions()
    {
        return [
            'fields',
            'entityClass',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOption()
    {
        return 'fields';
    }
}
