<?php

namespace App\Hrm\IdentityBundle\Doctrine\DBAL\Types\Profile;

use App\Hrm\CommonBundle\Doctrine\DBAL\Types\StringAggregateIdType;
use App\Hrm\Identity\Domain\Model\Profile\ContactId;

class ContactIdType extends StringAggregateIdType
{
    const NAME = 'hrm_identity_profile_contact_id';

    protected function getClassName(): string
    {
        return ContactId::class;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
