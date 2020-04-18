<?php

namespace App\Hrm\Identity\Profile\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface ContactRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
