<?php

namespace App\Hrm\CompanyBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Company\Repository\CompanyRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineCompanyRepository extends EntityRepository implements CompanyRepository
{
    use ExtendedObjectRepositoryTrait;
}
