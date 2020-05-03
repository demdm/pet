<?php

namespace App\Hrm\IdentityBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Identity\Repository\ProfileRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineProfileRepository extends EntityRepository implements ProfileRepository
{
    use ExtendedObjectRepositoryTrait;
}
