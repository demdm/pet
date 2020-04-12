<?php

namespace App\Hrm\Identity\Domain\Model\User;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface UserRepository extends ObjectRepository, Selectable
{
}
