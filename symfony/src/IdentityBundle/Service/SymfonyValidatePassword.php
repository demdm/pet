<?php

namespace App\IdentityBundle\Service;

use App\IdentityBundle\Repository\AccountRepository;
use App\IdentityBundle\Security\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SymfonyValidatePassword implements ValidatePassword
{
    private UserPasswordEncoderInterface $userPasswordEncoder;
    private AccountRepository $accountRepository;

    public function __construct(
        UserPasswordEncoderInterface $userPasswordEncoder,
        AccountRepository $accountRepository
    ) {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->accountRepository = $accountRepository;
    }

    public function validate(string $email, string $rawPassword): bool
    {
        $account = $this->accountRepository->getOneBy(['email' => $email]);
        $user = User::mapFromAccount($account);

        return $this->userPasswordEncoder->isPasswordValid($user, $rawPassword);
    }
}
