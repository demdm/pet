<?php

namespace App\Hrm\Identity\Account\Facade;

use App\Hrm\Common\Service\CommitTransactionService;
use App\Hrm\Common\Service\GenerateIdentifierService;
use App\Hrm\Common\Type\EmailType;
use App\Hrm\Common\Type\StringType;
use App\Hrm\Common\Type\StringIdType;
use App\Hrm\Identity\Account\Model\Account;
use App\Hrm\Identity\Account\Model\AccountRole;
use App\Hrm\Identity\Account\Repository\AccountRepository;
use App\Hrm\Identity\Account\Service\HashPasswordService;
use App\Hrm\Identity\Profile\Model\ContactType;
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
            new StringIdType($this->generateIdentifierService->generate()),
            new StringType($request->firstName),
            new StringType($request->lastName)
        );

        $profile->addContact(
            new StringIdType($this->generateIdentifierService->generate()),
            new ContactType(ContactType::EMAIL),
            new StringType($request->email)
        );

        $account = Account::create(
            new StringIdType($this->generateIdentifierService->generate()),
            $profile,
            new EmailType($request->email),
            new StringType($this->hashPasswordService->hash($request->password)),
            AccountRole::setAll([AccountRole::USER, AccountRole::RECRUITER]),
            new DateTimeImmutable()
        );

        $this->accountRepository->add($account);

        $this->commitTransactionService->commit();
    }
}
