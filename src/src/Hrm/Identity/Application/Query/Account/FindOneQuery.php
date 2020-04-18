<?php

namespace App\Hrm\Identity\Application\Query\Account;

use App\Hrm\Identity\Domain\Model\Account\AccountId;
use App\Hrm\Identity\Domain\Model\Account\AccountRepository;

class FindOneQuery
{
    private AccountRepository $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function handle(FindOneRequest $request)
    {
        $accountId = new AccountId($request->accountId);

        return $this->accountRepository->find($accountId);
    }
}
