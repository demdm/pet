<?php

namespace App\CompanyBundle\Repository;

use App\CommonBundle\Repository\ExtendedObjectRepository;
use App\CompanyBundle\Entity\EmployeeRequest;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

/**
 * @method EmployeeRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployeeRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployeeRequest[]    findAll()
 * @method EmployeeRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method void                 add(EmployeeRequest $company)
 */
interface EmployeeRequestRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
