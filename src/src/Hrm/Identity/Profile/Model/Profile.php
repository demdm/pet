<?php

namespace App\Hrm\Identity\Profile\Model;

use App\Hrm\Common\Type\String1_256Type;
use App\Hrm\Common\Type\StringIdType;
use App\Hrm\Identity\Account\Model\Account;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;

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
        StringIdType $id,
        String1_256Type $firstName,
        String1_256Type $lastName
    ): self
    {
        $self = new self();
        $self->id = $id->toString();
        $self->firstName = $firstName->toString();
        $self->lastName = $lastName->toString();

        return $self;
    }

    public function addContact(
        StringIdType $id,
        ContactType $type,
        String1_256Type $value,
        bool $isPublic = false,
        ?String1_256Type $description = null
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
