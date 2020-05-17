<?php

namespace App\CompanyBundle\Repository;

use App\CommonBundle\Repository\ExtendedObjectRepositoryTrait;
use Doctrine\ORM\EntityRepository;

class DoctrinePositionRepository extends EntityRepository implements PositionRepository
{
    use ExtendedObjectRepositoryTrait;
}
