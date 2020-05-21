<?php

namespace App\IdentityBundle\Service;

interface ValidatePassword
{
    public function validate(string $email, string $rawPassword): bool;
}
