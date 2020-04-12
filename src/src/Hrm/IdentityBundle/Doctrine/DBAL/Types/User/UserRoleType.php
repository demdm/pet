<?php

namespace App\Hrm\IdentityBundle\Doctrine\DBAL\Types\User;

use App\Hrm\Identity\Domain\Model\User\UserRole;
use Doctrine\DBAL\Types\SimpleArrayType;

class UserRoleType extends SimpleArrayType
{
    const NAME = 'hrm_identity_user_user_role';

    protected function getClassName(): string
    {
        return UserRole::class;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
