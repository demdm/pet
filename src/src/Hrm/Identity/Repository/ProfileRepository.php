<?php

namespace App\Hrm\Identity\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface ProfileRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
