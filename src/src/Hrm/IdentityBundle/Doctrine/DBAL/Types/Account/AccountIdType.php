<?php

namespace App\Hrm\IdentityBundle\Doctrine\DBAL\Types\Account;

use App\Hrm\CommonBundle\Doctrine\DBAL\Types\StringAggregateIdType;
use App\Hrm\Identity\Domain\Model\Account\AccountId;

class AccountIdType extends StringAggregateIdType
{
    const NAME = 'hrm_identity_account_account_id';

    protected function getClassName(): string
    {
        return AccountId::class;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
