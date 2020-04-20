<?php

namespace App\Hrm\Identity\Profile\Model;

use App\Hrm\Common\Type\StringIdType;
use App\Hrm\Common\Type\StringType;

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
        StringType $value,
        bool $isPublic = false,
        ?StringType $description = null
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
