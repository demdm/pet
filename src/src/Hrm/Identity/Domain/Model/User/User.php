<?php

namespace App\Hrm\Identity\Domain\Model\User;

use App\Hrm\Common\Domain\Model\Email;
use DateTimeImmutable;
use DateTimeInterface;

class User
{
    private UserId $id;

    private Email $email;

    private string $passwordHash;

    private UserRole $roles;

    private bool $isEmailConfirmed = false;

    private bool $canLoggedIn = true;

    private DateTimeImmutable $createdAt;

    private ?DateTimeInterface $loggedInAt;
}
