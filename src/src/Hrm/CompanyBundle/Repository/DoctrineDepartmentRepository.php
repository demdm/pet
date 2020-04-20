<?php

namespace App\Hrm\CompanyBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Company\Model\Department;
use App\Hrm\Company\Repository\DepartmentRepository;
use Doctrine\ORM\EntityRepository;

/**
 * @method Department|null find($id, $lockMode = null, $lockVersion = null)
 * @method Department|null findOneBy(array $criteria, array $orderBy = null)
 * @method Department[]    findAll()
 * @method Department[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method void            add(Department $department)
 */
class DoctrineDepartmentRepository extends EntityRepository implements DepartmentRepository
{
    use ExtendedObjectRepositoryTrait;
}
