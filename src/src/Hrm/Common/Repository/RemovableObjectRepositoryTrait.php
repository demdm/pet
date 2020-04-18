<?php

namespace App\Hrm\Common\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Trait.
 */
trait RemovableObjectRepositoryTrait
{
    /**
     * Removes an entity instance.
     *
     * A removed entity will be removed from the database at or before transaction commit
     * or as a result of the flush operation.
     *
     * @param object $object The entity instance to remove.
     *
     * @throws
     */
    public function remove($object)
    {
        /** @var EntityRepository $this */

        $this->getEntityManager()->remove($object);
    }
}
