<?php

namespace App\Hrm\Identity\Profile\Model;

use App\Hrm\Common\Type\StringEnumType;

final class ContactType extends StringEnumType
{
    const PHONE = 'phone';
    const EMAIL = 'email';
    const LINKEDIN = 'linkedin';
    const FACEBOOK = 'facebook';
    const VK = 'vk';
    const INSTAGRAM = 'instagram';
    const ODNOKLASSNIKI = 'odnoklassniki';
    const TELEGRAM = 'telegram';
    const SKYPE = 'skype';
    const VIBER = 'viber';
    const WHATSUP = 'whats_up';
}
