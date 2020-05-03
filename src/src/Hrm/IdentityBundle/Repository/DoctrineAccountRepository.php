<?php

namespace App\Hrm\IdentityBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Identity\Repository\AccountRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineAccountRepository extends EntityRepository implements AccountRepository
{
    use ExtendedObjectRepositoryTrait;
}
