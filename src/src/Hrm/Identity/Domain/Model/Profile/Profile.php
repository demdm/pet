<?php

namespace App\Hrm\Identity\Domain\Model\Profile;

use App\Hrm\Identity\Domain\Model\Account\AccountId;
use DateTimeInterface;

class Profile
{
    private ProfileId $id;

    private AccountId $accountId;

    private string $firstName;

    private string $lastName;

    private ?string $middleName;

    private ?string $photoPath;

    private ?string $address;

    private ?DateTimeInterface $birthDate;

    /**
     * @var Contact[]|null
     */
    private array $contactList;
}
