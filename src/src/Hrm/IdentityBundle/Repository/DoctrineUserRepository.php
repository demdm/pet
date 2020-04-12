<?php

namespace App\Hrm\IdentityBundle\Repository;

use App\Hrm\Identity\Domain\Model\User\User;
use App\Hrm\Identity\Domain\Model\User\UserRepository;
use Doctrine\ORM\EntityRepository;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineUserRepository extends EntityRepository implements UserRepository
{
}
