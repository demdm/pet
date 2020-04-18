<?php

namespace App\Hrm\Common\Domain\Model\Repository;

/**
 * Interface.
 */
interface RemovableObjectRepository
{
    /**
     * Remove an object from collection.
     *
     * @param object $object The entity instance
     */
    public function remove($object);
}
