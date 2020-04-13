<?php

namespace App\Hrm\IdentityBundle\Doctrine\DBAL\Types\Profile;

use App\Hrm\CommonBundle\Doctrine\DBAL\Types\StringAggregateIdType;
use App\Hrm\Identity\Domain\Model\Profile\ProfileId;

class ProfileIdType extends StringAggregateIdType
{
    const NAME = 'hrm_identity_profile_profile_id';

    protected function getClassName(): string
    {
        return ProfileId::class;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
