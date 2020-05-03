<?php

namespace App\Hrm\Identity\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepository;
use App\Hrm\Identity\Model\Profile;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * @method Profile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Profile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Profile[]    findAll()
 * @method Profile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface ProfileRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
