<?php

namespace App\Hrm\Identity\Domain\Model\Profile;

class Contact
{
    private ContactId $id;

    private ProfileId $profileId;

    private ContactType $type;

    private string $value;

    private ?string $description;

    private bool $isPublic;
}
