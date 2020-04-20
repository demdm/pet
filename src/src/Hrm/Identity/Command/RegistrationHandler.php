<?php

namespace App\Hrm\Identity\Command;

use App\Hrm\Common\Service\CommitTransaction;
use App\Hrm\Common\Service\GenerateIdentifier;
use App\Hrm\Identity\Service\HashPassword;
use App\Hrm\Identity\Model\Account;
use App\Hrm\Identity\Model\Contact;
use App\Hrm\Identity\Model\Profile;
use App\Hrm\Identity\Repository\ProfileRepository;
use DateTimeImmutable;

final class RegistrationHandler
{
    private GenerateIdentifier $generateIdentifier;
    private CommitTransaction $commitTransaction;
    private HashPassword $hashPassword;
    private ProfileRepository $profileRepository;

    public function __construct(
        GenerateIdentifier $generateIdentifier,
        CommitTransaction $commitTransaction,
        HashPassword $hashPassword,
        ProfileRepository $profileRepository
    ) {
        $this->generateIdentifier = $generateIdentifier;
        $this->commitTransaction = $commitTransaction;
        $this->hashPassword = $hashPassword;
        $this->profileRepository = $profileRepository;
    }

    public function handle(Registration $command): void
    {
        $account = Account::create(
            $this->generateIdentifier->generate(),
            $command->email,
            $this->hashPassword->hash($command->password),
            [Account::ROLE_USER],
            new DateTimeImmutable()
        );

        $profile = Profile::create(
            $account,
            $this->generateIdentifier->generate(),
            $command->firstName,
            $command->lastName
        );

        $profile->addContact(
            $this->generateIdentifier->generate(),
            Contact::TYPE_EMAIL,
            $command->email
        );

        $this->profileRepository->add($profile);

        $this->commitTransaction->commit();
    }
}
