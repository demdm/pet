<?php

namespace App\Hrm\Common\Repository;

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
