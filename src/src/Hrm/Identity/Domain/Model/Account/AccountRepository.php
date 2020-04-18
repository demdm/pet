<?php

namespace App\Hrm\Identity\Domain\Model\Account;

use App\Hrm\Common\Domain\Model\Repository\ExtendedObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface AccountRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
