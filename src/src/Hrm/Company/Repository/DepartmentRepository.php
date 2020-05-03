<?php

namespace App\Hrm\Company\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepository;
use App\Hrm\Company\Model\Department;
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
