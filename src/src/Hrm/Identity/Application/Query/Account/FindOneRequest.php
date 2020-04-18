<?php

namespace App\Hrm\Identity\Application\Query\Account;

class FindOneRequest
{
    public string $accountId;

    public function __construct(string $accountId)
    {
        $this->accountId = $accountId;
    }
}
