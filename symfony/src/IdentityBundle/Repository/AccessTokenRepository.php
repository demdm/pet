<?php

namespace App\IdentityBundle\Repository;

use App\CommonBundle\Repository\ExtendedObjectRepository;
use App\IdentityBundle\Entity\AccessToken;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

/**
 * @method AccessToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccessToken      get($id, $lockMode = null, $lockVersion = null)
 * @method AccessToken      getOneBy($id, $lockMode = null, $lockVersion = null)
 * @method AccessToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccessToken[]    findAll()
 * @method AccessToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface AccessTokenRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
