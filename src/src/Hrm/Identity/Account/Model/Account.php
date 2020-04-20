<?php

namespace App\Hrm\Identity\Account\Model;

use App\Hrm\Common\Type\EmailType;
use App\Hrm\Common\Type\ArrayEnumType;
use App\Hrm\Common\Type\StringIdType;
use App\Hrm\Common\Type\StringType;
use App\Hrm\Identity\Profile\Model\Profile;
use DateTimeImmutable;

final class Account
{
    private string $id;
    private Profile $profile;
    private string $email;
    private string $passwordHash;
    private array $roles;
    private DateTimeImmutable $createdAt;
    private string $profileId;

    private function __construct()
    {
    }

    public static function create(
        StringIdType $id,
        Profile $profile,
        EmailType $email,
        StringType $passwordHash,
        ArrayEnumType $roles,
        DateTimeImmutable $createdAt
    ): self
    {
        $self = new self();
        $self->id = $id->toString();
        $self->profile = $profile;
        $self->email = $email->toString();
        $self->passwordHash = $passwordHash->toString();
        $self->roles = $roles->toArray();
        $self->createdAt = $createdAt;

        return $self;
    }
}
