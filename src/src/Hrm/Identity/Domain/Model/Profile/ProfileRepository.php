<?php

namespace App\Hrm\Identity\Domain\Model\Profile;

use App\Hrm\Common\Domain\Model\Repository\ExtendedObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface ProfileRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
