<?php

namespace Hrm\Common\Domain\Exception;

use Throwable;

/**
 * Class.
 */
class ModelNotFoundException extends DomainException
{
    /**
     * {@inheritdoc}
     */
    public function __construct($message = '', $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param string $class
     * @param mixed  $id
     *
     * @return static
     */
    public static function fromClassAndId($class, $id)
    {
        return new self(
            sprintf(
                'Model "%s" with id="%s" not found.',
                $class,
                $id
            )
        );
    }

    /**
     * @param string $class
     * @param array  $criteria
     *
     * @return static
     */
    public static function fromClassAndCriteria($class, array $criteria)
    {
        return new self(
            sprintf(
                'Model "%s" not found with criteria: %s.',
                $class,
                json_encode($criteria)
            )
        );
    }
}
