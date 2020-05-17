<?php

namespace App\IdentityBundle\MessageHandler;

use App\CommonBundle\Service\GenerateIdentifier;
use App\IdentityBundle\Message\Registration;
use App\IdentityBundle\Service\HashPassword;
use App\IdentityBundle\Entity\Account;
use App\IdentityBundle\Entity\Contact;
use App\IdentityBundle\Entity\Profile;
use App\IdentityBundle\Repository\ProfileRepository;
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
            $message->name
        );

        $profile->addContact(
            $this->generateIdentifier->generate(),
            Contact::TYPE_EMAIL,
            $message->email
        );

        $this->profileRepository->add($profile);
    }
}
