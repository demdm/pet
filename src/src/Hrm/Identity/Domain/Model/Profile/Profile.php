<?php

namespace App\Hrm\Identity\Domain\Model\Profile;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;

class Profile
{
    private ProfileId $id;
    private string $firstName;
    private string $lastName;
    private ?string $middleName;
    private ?string $photoPath;
    private ?string $address;
    private ?DateTimeInterface $birthDate;

    /** @var Contact[]|ArrayCollection  */
    private ArrayCollection $contactList;

    final protected function __construct()
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

    public function addContact(Contact $contact)
    {
        $this->contactList->add($contact);
    }
}
