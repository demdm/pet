<?php

namespace App\CompanyBundle\Repository;

use App\CommonBundle\Repository\ExtendedObjectRepositoryTrait;
use Doctrine\ORM\EntityRepository;

class DoctrineCompanyRepository extends EntityRepository implements CompanyRepository
{
    use ExtendedObjectRepositoryTrait;
}
