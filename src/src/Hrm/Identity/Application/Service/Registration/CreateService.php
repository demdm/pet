<?php

namespace App\Hrm\Identity\Application\Service\Registration;

use App\Hrm\Common\Domain\Model\Email;
use App\Hrm\Common\Domain\Service\IdGenerator;
use App\Hrm\Identity\Domain\Model\Account\Account;
use App\Hrm\Identity\Domain\Model\Account\AccountId;
use App\Hrm\Identity\Domain\Model\Account\AccountRepository;
use App\Hrm\Identity\Domain\Model\Account\AccountRole;
use App\Hrm\Identity\Domain\Model\Profile\Contact;
use App\Hrm\Identity\Domain\Model\Profile\ContactId;
use App\Hrm\Identity\Domain\Model\Profile\ContactType;
use App\Hrm\Identity\Domain\Model\Profile\Profile;
use App\Hrm\Identity\Domain\Model\Profile\ProfileId;
use App\Hrm\Identity\Domain\Service\Account\AccountPasswordHasher;
use DateTimeImmutable;

final class CreateService
{
    private IdGenerator $idGenerator;
    private AccountPasswordHasher $accountPasswordHasher;
    private AccountRepository $accountRepository;

    public function handle(CreateRequest $request): void
    {
        $profileContact = Contact::create(
            new ContactId($this->idGenerator->generate()),
            ContactType::EMAIL(),
            $request->email
        );

        $profile = Profile::create(
            new ProfileId($this->idGenerator->generate()),
            $request->firstName,
            $request->lastName
        );

        $profile->addContact($profileContact);

        $account = Account::create(
            new AccountId($this->idGenerator->generate()),
            new Email($request->email),
            $this->accountPasswordHasher->hash($request->password),
            new AccountRole([AccountRole::USER]),
            new DateTimeImmutable(),
            $profile
        );

        $this->accountRepository->add($account);
    }
}
