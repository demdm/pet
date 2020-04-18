<?php

namespace App\Hrm\Identity\Domain\Model\Profile;

final class Contact
{
    private ContactId $id;
    private ContactType $type;
    private string $value;
    private ?string $description;
    private bool $isPublic;
    private ProfileId $profileId;
    private Profile $profile;

    final protected function __construct()
    {
    }

    public static function create(
        ContactId $id,
        Profile $profile,
        ContactType $type,
        string $value,
        bool $isPublic = false,
        ?string $description = null
    ): self
    {
        $self = new self();
        $self->id = $id;
        $self->profile = $profile;
        $self->type = $type;
        $self->value = $value;
        $self->description = $description;
        $self->isPublic = $isPublic;

        return $self;
    }
}
