<?php

namespace App\IdentityBundle\Repository;

use App\CommonBundle\Repository\ExtendedObjectRepositoryTrait;
use Doctrine\ORM\EntityRepository;

class DoctrineProfileRepository extends EntityRepository implements ProfileRepository
{
    use ExtendedObjectRepositoryTrait;
}
