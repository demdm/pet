<?php

namespace App\IdentityBundle\Service;

use App\IdentityBundle\Security\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class SymfonyHashPassword implements HashPassword
{
    private UserPasswordEncoderInterface $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function hash(string $plainPassword): string
    {
        return $this->userPasswordEncoder
            ->encodePassword(
                new User(),
                $plainPassword
            );
    }
}
