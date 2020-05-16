<?php

namespace App\Hrm\IdentityBundle\Service;

use App\Hrm\Identity\Model\Account;
use App\Hrm\Identity\Service\AccountIsEmployeeSpecification;

class DoctrineAccountIsEmployeeSpecification implements AccountIsEmployeeSpecification
{
    public function isSatisfiedBy(Account $account): bool
    {

    }
}
