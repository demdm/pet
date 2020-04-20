<?php

namespace App\Hrm\Company\Repository;

use App\Hrm\Common\Repository\ExtendedObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface PositionRepository extends ObjectRepository, Selectable, ExtendedObjectRepository
{
}
