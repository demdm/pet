<?php

namespace App\Hrm\IdentityBundle\Service\Domain\Account;

use App\Hrm\Identity\Domain\Service\Account\AccountPasswordHasher;
use App\Hrm\IdentityBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class SymfonyAccountPasswordHasher implements AccountPasswordHasher
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
