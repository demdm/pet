<?php

namespace App\Hrm\Identity\Model;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Webmozart\Assert\Assert;

final class Profile
{
    private string $id;
    private string $firstName;
    private string $lastName;
    private ?string $middleName;
    private ?string $photoPath;
    private ?string $address;
    private ?DateTimeInterface $birthDate;
    private Account $account;

    /** @var Contact[]|ArrayCollection */
    private $contactList;

    protected function __construct()
    {
        $this->contactList = new ArrayCollection();
    }

    public static function create(
        Account $account,
        string $id,
        string $firstName,
        string $lastName
    ): self
    {
        Assert::uuid($id);
        Assert::lengthBetween($firstName, 1, 50);
        Assert::lengthBetween($lastName, 1, 100);

        $self = new self();
        $self->account = $account;
        $self->id = $id;
        $self->firstName = $firstName;
        $self->lastName = $lastName;

        return $self;
    }

    public function addContact(
        string $id,
        string $type,
        string $value,
        bool $isPublic = false,
        ?string $description = null
    ): void
    {
        $contact = Contact::create(
            $id,
            $this,
            $type,
            $value,
            $isPublic,
            $description
        );

        $this->contactList->add($contact);
    }
}
