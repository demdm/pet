<?php

namespace App\Hrm\IdentityBundle\Repository\Account;

use App\Hrm\Common\Domain\Model\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Identity\Domain\Model\Account\Account;
use App\Hrm\Identity\Domain\Model\Account\AccountRepository;
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
