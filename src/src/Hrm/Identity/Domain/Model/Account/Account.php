<?php

namespace App\Hrm\Identity\Domain\Model\Account;

use App\Hrm\Common\Domain\Model\Email;
use App\Hrm\Identity\Domain\Model\Profile\Profile;
use App\Hrm\Identity\Domain\Model\Profile\ProfileId;
use DateTimeImmutable;

class Account
{
    private AccountId $id;
    private Email $email;
    private string $passwordHash;
    private AccountRole $roles;
    private DateTimeImmutable $createdAt;
    private Profile $profile;

    final protected function __construct()
    {
    }

    public static function create(
        AccountId $id,
        Email $email,
        string $passwordHash,
        AccountRole $roles,
        DateTimeImmutable $createdAt,
        Profile $profile
    ): self
    {
        $self = new self();
        $self->id = $id;
        $self->email = $email;
        $self->passwordHash = $passwordHash;
        $self->roles = $roles;
        $self->createdAt = $createdAt;

        $self->profile = $profile;

        return $self;
    }
}
