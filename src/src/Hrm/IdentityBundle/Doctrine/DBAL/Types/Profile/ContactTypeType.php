<?php

namespace App\Hrm\IdentityBundle\Doctrine\DBAL\Types\Profile;

use App\Hrm\Doctrine\DBAL\Types\MysqlPhpEnumType;
use App\Hrm\Identity\Domain\Model\Profile\ContactType;

class ContactTypeType extends MysqlPhpEnumType
{
    const NAME = 'hrm_identity_profile_contact_type';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getClassName(): string
    {
        return ContactType::class;
    }
}
