<?php

namespace App\Hrm\CompanyBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Company\Repository\OfficeRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineOfficeRepository extends EntityRepository implements OfficeRepository
{
    use ExtendedObjectRepositoryTrait;
}
