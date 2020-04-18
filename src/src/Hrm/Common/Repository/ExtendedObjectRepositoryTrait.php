<?php

namespace App\Hrm\Common\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Trait.
 */
trait ExtendedObjectRepositoryTrait
{
    /**
     * Get an object by its primary key / identifier or throws exception.
     *
     * @param mixed    $id          The identifier.
     * @param int|null $lockMode    One of the \Doctrine\DBAL\LockMode::* constants
     *                              or NULL if no specific lock mode should be used
     *                              during the search.
     * @param int|null $lockVersion The lock version.
     *
     * @return object The entity instance or NULL if the entity can not be found.
     *
     * @throws ModelNotFoundException
     */
    public function get($id, $lockMode = null, $lockVersion = null)
    {
        /** @var EntityRepository $this */

        $object = $this->find($id, $lockMode, $lockVersion);

        if (null === $object) {
            throw ModelNotFoundException::fromClassAndId($this->getEntityName(), $id);
        }

        return $object;
    }

    /**
     * Finds a single entity by a set of criteria.
     *
     * @param array $criteria
     * @param array|null $orderBy
     *
     * @return object The entity instance.
     *
     * @throws ModelNotFoundException
     */
    public function getOneBy(array $criteria, array $orderBy = null)
    {
        $object = $this->findOneBy($criteria, $orderBy);

        if (null === $object) {
            throw ModelNotFoundException::fromClassAndCriteria($this->getEntityName(), $criteria);
        }

        return $object;
    }

    /**
     * Add an object to collection by persisting
     *
     * @param object object
     */
    public function add($object)
    {
        /** @var EntityRepository $this */

        $this->getEntityManager()->persist($object);
    }
}
