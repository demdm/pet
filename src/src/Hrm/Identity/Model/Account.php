<?php

namespace App\Hrm\Identity\Model;

use App\Hrm\Company\Model\Company;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use InvalidArgumentException;
use Webmozart\Assert\Assert;

final class Account
{
    const ROLE_ADMINISTRATOR = 'administrator';
    const ROLE_COMPANY_OWNER = 'company_owner';
    const ROLE_HR_MANAGER = 'hr_manager';
    const ROLE_RECRUITER = 'recruiter';
    const ROLE_EMPLOYEE = 'employee';
    const ROLE_USER = 'user';

    const ROLE_LIST = [
        self::ROLE_ADMINISTRATOR,
        self::ROLE_COMPANY_OWNER,
        self::ROLE_HR_MANAGER,
        self::ROLE_RECRUITER,
        self::ROLE_EMPLOYEE,
        self::ROLE_USER,
    ];

    private string $id;
    private string $email;
    private string $passwordHash;
    private array $roles;
    private DateTimeImmutable $createdAt;
    private Profile $profile;

    /** @var Company[]|ArrayCollection */
    private $ownedCompanyList;

    private function __construct()
    {
        $this->roles = [];
    }

    public static function create(
        string $id,
        string $email,
        string $passwordHash,
        array $roles,
        DateTimeImmutable $createdAt
    ): self
    {
        Assert::uuid($id);
        Assert::email($email);
        Assert::lengthBetween($passwordHash, 1, 256);

        $self = new self();
        $self->id = $id;
        $self->email = $email;
        $self->passwordHash = $passwordHash;
        $self->addRoles($roles);
        $self->createdAt = $createdAt;

        return $self;
    }

    public function makeCompanyOwner(Company $company): void
    {
        $this->ownedCompanyList->add($company);

        if (!in_array(self::ROLE_COMPANY_OWNER, $this->roles, true)) {
            $this->roles[] = self::ROLE_COMPANY_OWNER;
        }
    }

    public function addRole(string $role): void
    {
        Assert::oneOf($role, self::ROLE_LIST);

        if ($role === self::ROLE_COMPANY_OWNER) {
            throw new InvalidArgumentException('Use "makeOwner" method.');
        }

        if (!in_array($role, $this->roles)) {
            $this->roles[] = $role;
        }
    }

    public function addRoles(array $roles)
    {
        foreach ($roles as $role) {
            $this->addRole($role);
        }
    }
}
