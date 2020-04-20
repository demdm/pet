<?php

namespace App\Hrm\CompanyBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Company\Model\Office;
use App\Hrm\Company\Repository\OfficeRepository;
use Doctrine\ORM\EntityRepository;

/**
 * @method Office|null find($id, $lockMode = null, $lockVersion = null)
 * @method Office|null findOneBy(array $criteria, array $orderBy = null)
 * @method Office[]    findAll()
 * @method Office[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method void        add(Office $office)
 */
class DoctrineOfficeRepository extends EntityRepository implements OfficeRepository
{
    use ExtendedObjectRepositoryTrait;
}
