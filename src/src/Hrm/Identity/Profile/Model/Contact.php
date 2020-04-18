<?php

namespace App\Hrm\Identity\Profile\Model;

use App\Hrm\Common\Type\StringIdType;
use App\Hrm\Common\Type\String1_256Type;

final class Contact
{
    private string $id;
    private Profile $profile;
    private string $type;
    private string $value;
    private bool $isPublic;
    private ?string $description;
    private string $profileId;

    final protected function __construct()
    {
    }

    public static function create(
        StringIdType $id,
        Profile $profile,
        ContactType $type,
        String1_256Type $value,
        bool $isPublic = false,
        ?String1_256Type $description = null
    ): self
    {
        $self = new self();
        $self->id = $id->toString();
        $self->profile = $profile;
        $self->type = $type->toString();
        $self->value = $value->toString();
        $self->isPublic = $isPublic;
        $self->description = null !== $description ? $description->toString() : null;

        return $self;
    }
}
