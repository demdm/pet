<?php

namespace App\Hrm\Identity\Service;

use App\Hrm\Identity\Model\Account;

interface AccountIsEmployeeSpecification
{
    /**
     * @param Account $account
     * @return bool
     */
    public function isSatisfiedBy(Account $account): bool;
}
