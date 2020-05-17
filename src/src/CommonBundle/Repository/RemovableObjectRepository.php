<?php

namespace App\CommonBundle\Repository;

interface RemovableObjectRepository
{
    /**
     * Remove an object from collection.
     *
     * @param object $object The entity instance
     */
    public function remove($object);
}
