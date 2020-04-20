<?php

namespace App\Hrm\CompanyBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Company\Model\Position;
use App\Hrm\Company\Repository\PositionRepository;
use Doctrine\ORM\EntityRepository;

/**
 * @method Position|null find($id, $lockMode = null, $lockVersion = null)
 * @method Position|null findOneBy(array $criteria, array $orderBy = null)
 * @method Position[]    findAll()
 * @method Position[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method void          add(Position $position)
 */
class DoctrinePositionRepository extends EntityRepository implements PositionRepository
{
    use ExtendedObjectRepositoryTrait;
}
