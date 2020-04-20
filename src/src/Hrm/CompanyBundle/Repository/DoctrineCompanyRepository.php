<?php

namespace App\Hrm\CompanyBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Company\Model\Company;
use App\Hrm\Company\Repository\CompanyRepository;
use Doctrine\ORM\EntityRepository;

/**
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method void         add(Company $company)
 */
class DoctrineCompanyRepository extends EntityRepository implements CompanyRepository
{
    use ExtendedObjectRepositoryTrait;
}
