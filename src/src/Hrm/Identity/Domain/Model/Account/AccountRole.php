<?php

namespace App\Hrm\Identity\Domain\Model\Account;

use Webmozart\Assert\Assert;

final class AccountRole
{
    const ADMINISTRATOR = 'administrator';
    const COMPANY_OWNER = 'company_owner';
    const HR_MANAGER = 'hr_manager';
    const RECRUITER = 'recruiter';
    const EMPLOYEE = 'employee';
    const USER = 'user';

    private const USER_ROLE_LIST = [
        self::ADMINISTRATOR,
        self::COMPANY_OWNER,
        self::HR_MANAGER,
        self::RECRUITER,
        self::EMPLOYEE,
        self::USER,
    ];

    /** @var string[] */
    private array $value;

    public function __construct(string $roleName)
    {
        $this->isValid($roleName);

        $this->value = [$roleName];
    }

    public function getValue(): array
    {
        return $this->value;
    }

    public function addRole(string $roleName): void
    {
        $this->isValid($roleName);

        if (!isset($this->value[$roleName])) {
            $this->value[] = $roleName;
        }
    }

    private function isValid(string $roleName): void
    {
        Assert::true(in_array($roleName, self::USER_ROLE_LIST, true));
    }

    public function __toString(): string
    {
        return json_encode($this->value);
    }
}
