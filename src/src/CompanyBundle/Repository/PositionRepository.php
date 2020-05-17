<?php

namespace App\CompanyBundle\Repository;

use App\CommonBundle\Repository\ExtendedObjectRepository;
use App\CompanyBundle\Entity\Position;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

/**
 * @method Position|null find($id, $lockMode = null, $lockVersion = null)
 * @method Position|null findOneBy(array $criteria, array $orderBy = null)
 * @method Position[]    findAll()
 * @method Position[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method void          add(Position $position)
 */
interface PositionRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
