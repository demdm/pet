<?php

namespace App\Hrm\CompanyBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Company\Repository\DepartmentRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineDepartmentRepository extends EntityRepository implements DepartmentRepository
{
    use ExtendedObjectRepositoryTrait;
}
