<?php

namespace App\Hrm\IdentityBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Identity\Model\Account;
use App\Hrm\Identity\Repository\AccountRepository;
use Doctrine\ORM\EntityRepository;

/**
 * @method Account|null find($id, $lockMode = null, $lockVersion = null)
 * @method Account|null findOneBy(array $criteria, array $orderBy = null)
 * @method Account[]    findAll()
 * @method Account[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineAccountRepository extends EntityRepository implements AccountRepository
{
    use ExtendedObjectRepositoryTrait;
}
