<?php

namespace App\Hrm\CompanyBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Company\Repository\PositionRepository;
use Doctrine\ORM\EntityRepository;

class DoctrinePositionRepository extends EntityRepository implements PositionRepository
{
    use ExtendedObjectRepositoryTrait;
}
