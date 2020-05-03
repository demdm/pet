<?php

namespace App\Hrm\Company\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepository;
use App\Hrm\Company\Model\Office;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

/**
 * @method Office|null find($id, $lockMode = null, $lockVersion = null)
 * @method Office|null findOneBy(array $criteria, array $orderBy = null)
 * @method Office[]    findAll()
 * @method Office[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method void        add(Office $office)
 */
interface OfficeRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
