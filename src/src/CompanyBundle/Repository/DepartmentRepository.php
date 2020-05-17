<?php

namespace App\CompanyBundle\Repository;

use App\CommonBundle\Repository\ExtendedObjectRepository;
use App\CompanyBundle\Entity\Department;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

/**
 * @method Department|null find($id, $lockMode = null, $lockVersion = null)
 * @method Department|null findOneBy(array $criteria, array $orderBy = null)
 * @method Department[]    findAll()
 * @method Department[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method void            add(Department $department)
 */
interface DepartmentRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
