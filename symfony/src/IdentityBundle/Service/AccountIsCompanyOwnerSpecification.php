<?php

namespace App\IdentityBundle\Service;

use App\IdentityBundle\Entity\Account;

interface AccountIsCompanyOwnerSpecification
{
    /**
     * @param Account $account
     * @return bool
     */
    public function isSatisfiedBy(Account $account): bool;
}
