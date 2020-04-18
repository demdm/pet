<?php

namespace App\Hrm\Identity\Domain\Model\Profile;

use App\Hrm\Identity\Domain\Model\Account\Account;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;

final class Profile
{
    private ProfileId $id;
    private string $firstName;
    private string $lastName;
    private ?string $middleName;
    private ?string $photoPath;
    private ?string $address;
    private ?DateTimeInterface $birthDate;

    /** @var Contact[]|ArrayCollection */
    private $contactList;

    private Account $account;

    protected function __construct()
    {
        $this->contactList = new ArrayCollection();
    }

    public static function create(
        ProfileId $id,
        string $firstName,
        string $lastName
    ): self
    {
        $self = new self();
        $self->id = $id;
        $self->firstName = $firstName;
        $self->lastName = $lastName;

        return $self;
    }

    public function addContact(
        ContactId $id,
        ContactType $type,
        string $value,
        bool $isPublic = false,
        ?string $description = null
    ): void
    {
        $contact = Contact::create(
            $id,
            $this,
            ContactType::EMAIL(),
            $value,
            $isPublic,
            $description
        );

        $this->contactList->add($contact);
    }
}
