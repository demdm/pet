<?php

namespace App\Hrm\Identity\Facade;

final class RegistrationRequest
{
    public string $uuid;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;

    public function __construct(
        string $uuid,
        string $firstName,
        string $lastName,
        string $email,
        string $password
    ) {
        $this->uuid = $uuid;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }
}
