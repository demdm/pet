<?php

namespace App\Hrm\IdentityBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Identity\Repository\ContactRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineContactRepository extends EntityRepository implements ContactRepository
{
    use ExtendedObjectRepositoryTrait;
}
