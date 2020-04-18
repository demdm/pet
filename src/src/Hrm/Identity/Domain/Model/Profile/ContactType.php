<?php

namespace App\Hrm\Identity\Domain\Model\Profile;

use MyCLabs\Enum\Enum;

/**
 * @method static ContactType PHONE()
 * @method static ContactType EMAIL()
 * @method static ContactType LINKEDIN()
 * @method static ContactType FACEBOOK()
 * @method static ContactType VK()
 * @method static ContactType INSTAGRAM()
 * @method static ContactType ODNOKLASSNIKI()
 * @method static ContactType TELEGRAM()
 * @method static ContactType SKYPE()
 * @method static ContactType VIBER()
 * @method static ContactType WHATSUP()
 */
final class ContactType extends Enum
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
