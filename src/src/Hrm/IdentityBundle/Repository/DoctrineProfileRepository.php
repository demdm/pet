<?php

namespace App\Hrm\IdentityBundle\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepositoryTrait;
use App\Hrm\Identity\Model\Profile;
use App\Hrm\Identity\Repository\ProfileRepository;
use Doctrine\ORM\EntityRepository;

/**
 * @method Profile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Profile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Profile[]    findAll()
 * @method Profile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineProfileRepository extends EntityRepository implements ProfileRepository
{
    use ExtendedObjectRepositoryTrait;
}
