<?php

namespace App\Hrm\Identity\Model;

use App\Hrm\Identity\Model\Profile;
use DateTimeImmutable;
use Webmozart\Assert\Assert;

final class Account
{
    const ROLE_ADMINISTRATOR = 'administrator';
    const ROLE_COMPANY_OWNER = 'company_owner';
    const ROLE_HR_MANAGER = 'hr_manager';
    const ROLE_RECRUITER = 'recruiter';
    const ROLE_EMPLOYEE = 'employee';
    const ROLE_USER = 'user';

    const ROLE_LIST = [
        self::ROLE_ADMINISTRATOR,
        self::ROLE_COMPANY_OWNER,
        self::ROLE_HR_MANAGER,
        self::ROLE_RECRUITER,
        self::ROLE_EMPLOYEE,
        self::ROLE_USER,
    ];

    private string $id;
    private string $email;
    private string $passwordHash;
    private array $roles;
    private DateTimeImmutable $createdAt;
    private Profile $profile;

    private function __construct()
    {
    }

    public static function create(
        string $id,
        string $email,
        string $passwordHash,
        array $roles,
        DateTimeImmutable $createdAt
    ): self
    {
        Assert::uuid($id);
        Assert::email($email);
        Assert::lengthBetween($passwordHash, 1, 256);
        Assert::allOneOf($roles, self::ROLE_LIST);

        $self = new self();
        $self->id = $id;
        $self->email = $email;
        $self->passwordHash = $passwordHash;
        $self->roles = $roles;
        $self->createdAt = $createdAt;

        return $self;
    }
}
