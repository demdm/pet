<?php

namespace App\Hrm\CompanyBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Company\Repository\EmployeeRequestRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineEmployeeRequestRepository extends EntityRepository implements EmployeeRequestRepository
{
    use ExtendedObjectRepositoryTrait;
}
