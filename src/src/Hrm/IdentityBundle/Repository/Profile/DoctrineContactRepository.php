<?php

namespace App\Hrm\IdentityBundle\Repository\Profile;

use App\Hrm\Identity\Domain\Model\Profile\Contact;
use App\Hrm\Identity\Domain\Model\Profile\ContactRepository;
use Doctrine\ORM\EntityRepository;
use Hrm\Common\Domain\Model\Repository\ExtendedObjectRepositoryTrait;

/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineContactRepository extends EntityRepository implements ContactRepository
{
    use ExtendedObjectRepositoryTrait;
}
