<?php

namespace App\IdentityBundle\Message;

final class Registration
{
    public ?string $uuid = null;
    public ?string $firstName = null;
    public ?string $lastName = null;
    public ?string $email = null;
    public ?string $password = null;
}
