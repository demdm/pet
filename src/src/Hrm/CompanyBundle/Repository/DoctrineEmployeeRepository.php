<?php

namespace App\Hrm\CompanyBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Company\Repository\EmployeeRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineEmployeeRepository extends EntityRepository implements EmployeeRepository
{
    use ExtendedObjectRepositoryTrait;
}
