<?php

namespace App\Hrm\Identity\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepository;
use App\Hrm\Identity\Model\Contact;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface ContactRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
