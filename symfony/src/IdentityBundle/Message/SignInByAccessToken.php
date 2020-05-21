<?php

namespace App\IdentityBundle\Message;

final class SignInByAccessToken
{
    public string $accessToken;
    public string $email;
    public string $password;

    public function __construct(
        string $accessToken,
        string $email,
        string $password
    ) {
        $this->accessToken = $accessToken;
        $this->email = $email;
        $this->password = $password;
    }
}
