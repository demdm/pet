<?php

namespace App\Hrm\Identity\Domain\Model\User;

use Webmozart\Assert\Assert;

class UserRole
{
    const ADMINISTRATOR = 'administrator';
    const COMPANY_OWNER = 'company_owner';
    const HR_MANAGER = 'hr_manager';
    const RECRUITER = 'recruiter';
    const EMPLOYEE = 'employee';

    private const USER_ROLE_LIST = [
        self::ADMINISTRATOR,
        self::COMPANY_OWNER,
        self::HR_MANAGER,
        self::RECRUITER,
        self::EMPLOYEE,
    ];

    /** @var string[] */
    private array $value;

    public function __construct(array $value)
    {
        Assert::notEmpty($value);

        foreach ($value as $role) {
            Assert::true(in_array($role, self::USER_ROLE_LIST, true));
        }

        $this->value = $value;
    }

    public function getValue(): array
    {
        return $this->value;
    }
}
