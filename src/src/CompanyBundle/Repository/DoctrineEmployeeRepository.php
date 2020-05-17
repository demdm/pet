<?php

namespace App\CompanyBundle\Repository;

use App\CommonBundle\Repository\ExtendedObjectRepositoryTrait;
use Doctrine\ORM\EntityRepository;

class DoctrineEmployeeRepository extends EntityRepository implements EmployeeRepository
{
    use ExtendedObjectRepositoryTrait;
}
