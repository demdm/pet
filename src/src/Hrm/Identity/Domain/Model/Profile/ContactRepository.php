<?php

namespace App\Hrm\Identity\Domain\Model\Profile;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
use Hrm\Common\Domain\Model\Repository\ExtendedObjectRepository;

interface ContactRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
