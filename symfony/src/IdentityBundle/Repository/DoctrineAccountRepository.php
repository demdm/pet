<?php

namespace App\IdentityBundle\Repository;

use App\CommonBundle\Repository\ExtendedObjectRepositoryTrait;
use Doctrine\ORM\EntityRepository;

class DoctrineAccountRepository extends EntityRepository implements AccountRepository
{
    use ExtendedObjectRepositoryTrait;
}
