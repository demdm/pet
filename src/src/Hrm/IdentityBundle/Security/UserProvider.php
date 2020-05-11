<?php

namespace App\Hrm\IdentityBundle\Security;

use App\Hrm\Common\Repository\ModelNotFoundException;
use App\Hrm\Identity\Repository\AccountRepository;
use App\Hrm\IdentityBundle\Entity\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    private AccountRepository $accountRepository;

    public function __construct(
        AccountRepository $accountRepository
    ) {
        $this->accountRepository = $accountRepository;
    }

    /**
     * Symfony calls this method if you use features like switch_user
     * or remember_me.
     *
     * If you're not using these features, you do not need to implement
     * this method.
     *
     * @inheritDoc
     *
     * @throws ModelNotFoundException
     */
    public function loadUserByUsername(string $email)
    {
        $account = $this->accountRepository->getOneBy(['email' => $email]);

        return new User(
            $account->getId(),
            $account->getPasswordHash(),
            $account->getRoles()
        );
    }

    /**
     * Refreshes the user after being reloaded from the session.
     *
     * When a user is logged in, at the beginning of each request, the
     * User object is loaded from the session and then this method is
     * called. Your job is to make sure the user's data is still fresh by,
     * for example, re-querying for fresh User data.
     *
     * If your firewall is "stateless: true" (for a pure API), this
     * method is not called.
     *
     * @inheritDoc
     *
     * @throws ModelNotFoundException
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
        }

        $account = $this->accountRepository->get($user->getUsername());

        return new User(
            $account->getId(),
            $account->getPasswordHash(),
            $account->getRoles()
        );
    }

    /**
     * Tells Symfony to use this provider for this User class.
     *
     * @inheritDoc
     */
    public function supportsClass(string $class)
    {
        return User::class === $class;
    }
}