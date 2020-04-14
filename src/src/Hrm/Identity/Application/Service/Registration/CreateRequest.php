<?php

namespace App\Hrm\Identity\Application\Service\Registration;

final class CreateRequest
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }
}
