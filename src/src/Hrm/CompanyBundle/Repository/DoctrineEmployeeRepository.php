<?php

namespace App\Hrm\CompanyBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Company\Model\Employee;
use App\Hrm\Company\Repository\EmployeeRepository;
use Doctrine\ORM\EntityRepository;

/**
 * @method Employee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Employee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Employee[]    findAll()
 * @method Employee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method void          add(Employee $employee)
 */
class DoctrineEmployeeRepository extends EntityRepository implements EmployeeRepository
{
    use ExtendedObjectRepositoryTrait;
}
