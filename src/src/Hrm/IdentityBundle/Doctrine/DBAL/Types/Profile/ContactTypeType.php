<?php

namespace App\Hrm\IdentityBundle\Doctrine\DBAL\Types\Profile;

use App\Hrm\Identity\Domain\Model\Profile\ContactType;
use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

class ContactTypeType extends AbstractEnumType
{
    const NAME = 'hrm_identity_profile_contact_type';

    protected static $choices = [
        ContactType::PHONE,
        ContactType::EMAIL,
        ContactType::LINKEDIN,
        ContactType::FACEBOOK,
        ContactType::VK,
        ContactType::INSTAGRAM,
        ContactType::ODNOKLASSNIKI,
        ContactType::TELEGRAM,
        ContactType::SKYPE,
        ContactType::VIBER,
        ContactType::WHATSUP,
    ];
}
