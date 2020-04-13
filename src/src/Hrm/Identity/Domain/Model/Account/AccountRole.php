<?php

namespace App\Hrm\Identity\Domain\Model\Account;

use Webmozart\Assert\Assert;

class AccountRole
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

        array_walk($value, function (string $roleName) {
            Assert::true(in_array($roleName, self::USER_ROLE_LIST, true));
        });

        $this->value = $value;
    }

    public function getValue(): array
    {
        return $this->value;
    }
}
