<?php

namespace App\IdentityBundle\Repository;

use App\CommonBundle\Repository\ExtendedObjectRepositoryTrait;
use App\CommonBundle\Repository\RemovableObjectRepositoryTrait;
use Doctrine\ORM\EntityRepository;

class DoctrineAccessTokenRepository extends EntityRepository implements AccessTokenRepository
{
    use ExtendedObjectRepositoryTrait,
        RemovableObjectRepositoryTrait;
}
