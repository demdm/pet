<?php

namespace App\Hrm\Common\Domain\Model\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMInvalidArgumentException;

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
     * @throws ORMInvalidArgumentException
     */
    public function remove($object)
    {
        /** @var EntityRepository $this */

        $this->getEntityManager()->remove($object);
    }
}
