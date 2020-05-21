<?php

namespace App\IdentityBundle\Security;

use App\IdentityBundle\Entity\Account;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private string $id;
    private string $password;
    private array $roles;

    /**
     * Return Account ID
     *
     * @inheritDoc
     */
    public function getUsername(): string
    {
        return $this->id;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public static function mapFromAccount(Account $account): self
    {
        $user = new self();
        $user->id = $account->getId();
        $user->password = $account->getPasswordHash();
        $user->roles = $account->getRoles();

        return $user;
    }
}
