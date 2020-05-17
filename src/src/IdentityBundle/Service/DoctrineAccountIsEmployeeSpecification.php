<?php

namespace App\IdentityBundle\Service;

use App\IdentityBundle\Entity\Account;
use App\IdentityBundle\Service\AccountIsEmployeeSpecification;

class DoctrineAccountIsEmployeeSpecification implements AccountIsEmployeeSpecification
{
    public function isSatisfiedBy(Account $account): bool
    {

    }
}
