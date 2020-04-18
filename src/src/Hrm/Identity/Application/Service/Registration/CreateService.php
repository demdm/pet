<?php

namespace App\Hrm\Identity\Application\Service\Registration;

use App\Hrm\Common\Application\Service\UnitOfWork;
use App\Hrm\Common\Domain\Model\Email;
use App\Hrm\Common\Domain\Service\IdGenerator;
use App\Hrm\Identity\Domain\Model\Account\Account;
use App\Hrm\Identity\Domain\Model\Account\AccountId;
use App\Hrm\Identity\Domain\Model\Account\AccountRepository;
use App\Hrm\Identity\Domain\Model\Account\AccountRole;
use App\Hrm\Identity\Domain\Model\Profile\Contact;
use App\Hrm\Identity\Domain\Model\Profile\ContactId;
use App\Hrm\Identity\Domain\Model\Profile\ContactRepository;
use App\Hrm\Identity\Domain\Model\Profile\ContactType;
use App\Hrm\Identity\Domain\Model\Profile\Profile;
use App\Hrm\Identity\Domain\Model\Profile\ProfileId;
use App\Hrm\Identity\Domain\Model\Profile\ProfileRepository;
use App\Hrm\Identity\Domain\Service\Account\AccountPasswordHasher;
use DateTimeImmutable;

final class CreateService
{
    private IdGenerator $idGenerator;
    private UnitOfWork $unitOfWork;
    private AccountPasswordHasher $accountPasswordHasher;
    private AccountRepository $accountRepository;
    private ProfileRepository $profileRepository;
    private ContactRepository $contactRepository;

    public function __construct(
        IdGenerator $idGenerator,
        UnitOfWork $unitOfWork,
        AccountPasswordHasher $accountPasswordHasher,
        AccountRepository $accountRepository,
        ProfileRepository $profileRepository,
        ContactRepository $contactRepository
    ) {
        $this->idGenerator = $idGenerator;
        $this->unitOfWork = $unitOfWork;
        $this->accountPasswordHasher = $accountPasswordHasher;
        $this->accountRepository = $accountRepository;
        $this->profileRepository = $profileRepository;
        $this->contactRepository = $contactRepository;
    }

    public function handle(CreateRequest $request): void
    {
        $profileId = new ProfileId($this->idGenerator->generate());
        $profile = Profile::create(
            $profileId,
            $request->firstName,
            $request->lastName
        );
        $profile->addContact(
            new ContactId($this->idGenerator->generate()),
            ContactType::EMAIL(),
            $request->email
        );
//        $this->profileRepository->add($profile);

//        $this->contactRepository->add($profileContact);

        $account = Account::create(
            new AccountId($request->uuid),
            $profile,
            new Email($request->email),
            $this->accountPasswordHasher->hash($request->password),
            new AccountRole(AccountRole::USER),
            new DateTimeImmutable()
        );
        $this->accountRepository->add($account);

        $this->unitOfWork->commit();
    }
}
