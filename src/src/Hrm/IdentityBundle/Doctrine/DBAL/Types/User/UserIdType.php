<?php

namespace App\Hrm\IdentityBundle\Doctrine\DBAL\Types\User;

use App\Hrm\CommonBundle\Doctrine\DBAL\Types\StringAggregateIdType;
use App\Hrm\Identity\Domain\Model\User\UserId;

class UserIdType extends StringAggregateIdType
{
    const NAME = 'hrm_identity_user_user_id';

    protected function getClassName(): string
    {
        return UserId::class;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
