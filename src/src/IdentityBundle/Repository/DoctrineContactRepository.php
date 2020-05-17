<?php

namespace App\IdentityBundle\Repository;

use App\CommonBundle\Repository\ExtendedObjectRepositoryTrait;
use Doctrine\ORM\EntityRepository;

class DoctrineContactRepository extends EntityRepository implements ContactRepository
{
    use ExtendedObjectRepositoryTrait;
}
