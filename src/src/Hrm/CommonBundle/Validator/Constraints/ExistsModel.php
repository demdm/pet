<?php

namespace App\Hrm\CommonBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint for the Exists Model validator.
 *
 * @Annotation
 * @Target({"CLASS", "ANNOTATION"})
 */
class ExistsModel extends Constraint
{
    public $message = 'This value doesn\'t exists.';

    public $em = null;

    public $entityClass = null;

    public $repositoryMethod = 'findBy';

    public $fields = [];

    public $errorPath = null;

    public $ignoreNull = true;

    public $propertyToFieldMap = [];

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
