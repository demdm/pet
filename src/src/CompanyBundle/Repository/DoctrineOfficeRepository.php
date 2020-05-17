<?php

namespace App\CompanyBundle\Repository;

use App\CommonBundle\Repository\ExtendedObjectRepositoryTrait;
use Doctrine\ORM\EntityRepository;

class DoctrineOfficeRepository extends EntityRepository implements OfficeRepository
{
    use ExtendedObjectRepositoryTrait;
}
