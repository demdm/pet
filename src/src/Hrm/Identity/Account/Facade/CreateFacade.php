<?php

namespace App\Hrm\Identity\Account\Facade;

use App\Hrm\Common\Service\CommitTransactionService;
use App\Hrm\Common\Service\GenerateIdentifierService;
use App\Hrm\Identity\Account\Model\Account;
use App\Hrm\Identity\Account\Repository\AccountRepository;
use App\Hrm\Identity\Account\Service\HashPasswordService;
use App\Hrm\Identity\Profile\Model\Contact;
use App\Hrm\Identity\Profile\Model\Profile;
use DateTimeImmutable;

final class CreateFacade
{
    private GenerateIdentifierService $generateIdentifierService;
    private CommitTransactionService $commitTransactionService;
    private HashPasswordService $hashPasswordService;
    private AccountRepository $accountRepository;

    public function __construct(
        GenerateIdentifierService $generateIdentifierService,
        CommitTransactionService $commitTransactionService,
        HashPasswordService $hashPasswordService,
        AccountRepository $accountRepository
    ) {
        $this->generateIdentifierService = $generateIdentifierService;
        $this->commitTransactionService = $commitTransactionService;
        $this->hashPasswordService = $hashPasswordService;
        $this->accountRepository = $accountRepository;
    }

    public function handle(CreateFacadeRequest $request): void
    {
        $profile = Profile::create(
            $this->generateIdentifierService->generate(),
            $request->firstName,
            $request->lastName
        );

        $profile->addContact(
            $this->generateIdentifierService->generate(),
            Contact::TYPE_EMAIL,
            $request->email
        );

        $account = Account::create(
            $this->generateIdentifierService->generate(),
            $profile,
            $request->email,
            $this->hashPasswordService->hash($request->password),
            [
                Account::ROLE_USER,
                Account::ROLE_RECRUITER
            ],
            new DateTimeImmutable()
        );

        $this->accountRepository->add($account);

        $this->commitTransactionService->commit();
    }
}
