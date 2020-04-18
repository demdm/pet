<?php

namespace App\Hrm\Common\Repository;

/**
 * Interface.
 */
interface ExtendedObjectRepository
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
    public function get($id, $lockMode = null, $lockVersion = null);

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
    public function getOneBy(array $criteria, array $orderBy = null);

    /**
     * Add an object to collection
     *
     * @param object object
     */
    public function add($object);
}
