<?php

namespace App\Hrm\Identity\Domain\Model\Account;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
use Hrm\Common\Domain\Model\Repository\ExtendedObjectRepository;

interface AccountRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
