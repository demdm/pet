<?php

namespace App\Hrm\IdentityBundle\Doctrine\DBAL\Types\Account;

use App\Hrm\Identity\Domain\Model\Account\AccountRole;
use Doctrine\DBAL\Types\SimpleArrayType;

class AccountRoleType extends SimpleArrayType
{
    const NAME = 'hrm_identity_account_account_role';

    protected function getClassName(): string
    {
        return AccountRole::class;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
