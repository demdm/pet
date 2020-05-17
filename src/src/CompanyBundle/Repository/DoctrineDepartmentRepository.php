<?php

namespace App\CompanyBundle\Repository;

use App\CommonBundle\Repository\ExtendedObjectRepositoryTrait;
use Doctrine\ORM\EntityRepository;

class DoctrineDepartmentRepository extends EntityRepository implements DepartmentRepository
{
    use ExtendedObjectRepositoryTrait;
}
