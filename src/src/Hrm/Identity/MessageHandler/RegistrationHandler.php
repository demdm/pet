<?php

namespace App\Hrm\Identity\MessageHandler;

use App\Hrm\Common\Service\GenerateIdentifier;
use App\Hrm\Identity\Message\Registration;
use App\Hrm\Identity\Service\HashPassword;
use App\Hrm\Identity\Model\Account;
use App\Hrm\Identity\Model\Contact;
use App\Hrm\Identity\Model\Profile;
use App\Hrm\Identity\Repository\ProfileRepository;
use DateTimeImmutable;

final class RegistrationHandler
{
    private GenerateIdentifier $generateIdentifier;
    private HashPassword $hashPassword;
    private ProfileRepository $profileRepository;

    public function __construct(
        GenerateIdentifier $generateIdentifier,
        HashPassword $hashPassword,
        ProfileRepository $profileRepository
    ) {
        $this->generateIdentifier = $generateIdentifier;
        $this->hashPassword = $hashPassword;
        $this->profileRepository = $profileRepository;
    }

    public function __invoke(Registration $message): void
    {
        $account = Account::create(
            $message->uuid,
            $message->email,
            $this->hashPassword->hash($message->password),
            [Account::ROLE_USER],
            new DateTimeImmutable()
        );

        $profile = Profile::create(
            $account,
            $this->generateIdentifier->generate(),
            $message->firstName,
            $message->lastName
        );

        $profile->addContact(
            $this->generateIdentifier->generate(),
            Contact::TYPE_EMAIL,
            $message->email
        );

        $this->profileRepository->add($profile);
    }
}
