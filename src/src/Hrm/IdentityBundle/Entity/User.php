<?php

namespace App\Hrm\IdentityBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private string $id;
    private string $password;
    private array $roles;

    public function __construct(
        string $id,
        string $password,
        array $roles
    ) {
        $this->id = $id;
        $this->password = $password;
        $this->roles = $roles;
    }

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
}
