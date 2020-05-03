<?php

namespace App\Hrm\Identity\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepository;
use App\Hrm\Identity\Model\Account;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

/**
 * @method Account|null find($id, $lockMode = null, $lockVersion = null)
 * @method Account      get($id, $lockMode = null, $lockVersion = null)
 * @method Account|null findOneBy(array $criteria, array $orderBy = null)
 * @method Account[]    findAll()
 * @method Account[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface AccountRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
