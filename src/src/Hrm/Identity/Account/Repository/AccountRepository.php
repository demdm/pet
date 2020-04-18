<?php

namespace App\Hrm\Identity\Account\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface AccountRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
