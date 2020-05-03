<?php

namespace App\Hrm\Company\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepository;
use App\Hrm\Company\Model\Company;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

/**
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method void         add(Company $company)
 */
interface CompanyRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
