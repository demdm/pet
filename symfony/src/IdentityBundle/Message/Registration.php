<?php

namespace App\IdentityBundle\Message;

final class Registration
{
    public string $uuid;
    public ?string $name;
    public ?string $email;
    public ?string $password;
}
