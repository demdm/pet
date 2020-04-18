<?php

namespace App\Hrm\Identity\Domain\Model\Account;

use App\Hrm\Common\Domain\Model\Email;
use App\Hrm\Identity\Domain\Model\Profile\Profile;
use App\Hrm\Identity\Domain\Model\Profile\ProfileId;
use DateTimeImmutable;

final class Account
{
    private AccountId $id;
    private Profile $profile;
    private Email $email;
    private string $passwordHash;
    private AccountRole $roles;
    private DateTimeImmutable $createdAt;
    private ProfileId $profileId;

    protected function __construct()
    {
    }

    public static function create(
        AccountId $id,
        Profile $profile,
        Email $email,
        string $passwordHash,
        AccountRole $roles,
        DateTimeImmutable $createdAt
    ): self
    {
        $self = new self();
        $self->id = $id;
        $self->profile = $profile;
        $self->email = $email;
        $self->passwordHash = $passwordHash;
        $self->roles = $roles;
        $self->createdAt = $createdAt;

        return $self;
    }
}
