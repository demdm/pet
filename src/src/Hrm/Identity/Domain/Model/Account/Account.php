<?php

namespace App\Hrm\Identity\Domain\Model\Account;

use App\Hrm\Common\Domain\Model\Email;
use DateTimeImmutable;

class Account
{
    private AccountId $id;

    private Email $email;

    private string $passwordHash;

    private AccountRole $roles;

    private DateTimeImmutable $createdAt;
}
