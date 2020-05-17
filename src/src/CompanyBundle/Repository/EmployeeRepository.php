<?php

namespace App\CompanyBundle\Repository;

use App\CommonBundle\Repository\ExtendedObjectRepository;
use App\CompanyBundle\Entity\Employee;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

/**
 * @method Employee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Employee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Employee[]    findAll()
 * @method Employee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method void          add(Employee $employee)
 */
interface EmployeeRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
