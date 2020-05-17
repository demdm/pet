<?php

namespace App\CompanyBundle\Repository;

use App\CommonBundle\Repository\ExtendedObjectRepositoryTrait;
use Doctrine\ORM\EntityRepository;

class DoctrineEmployeeRequestRepository extends EntityRepository implements EmployeeRequestRepository
{
    use ExtendedObjectRepositoryTrait;
}
