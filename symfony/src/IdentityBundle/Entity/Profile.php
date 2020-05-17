<?php

namespace App\IdentityBundle\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Webmozart\Assert\Assert;

final class Profile
{
    private string $id;
    private string $name;
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
        string $name
    ): self
    {
        Assert::uuid($id);
        Assert::lengthBetween($name, 1, 100);

        $self = new self();
        $self->account = $account;
        $self->id = $id;
        $self->name = $name;

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
