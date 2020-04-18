<?php

namespace App\Hrm\IdentityBundle\Service;

use App\Hrm\Identity\Account\Service\HashPasswordService;
use App\Hrm\IdentityBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class SymfonyHashPasswordService implements HashPasswordService
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
