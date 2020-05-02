<?php

namespace App\Hrm\Identity\Model;

use Webmozart\Assert\Assert;

final class Contact
{
    const TYPE_PHONE = 'phone';
    const TYPE_EMAIL = 'email';
    const TYPE_LINKEDIN = 'linkedin';
    const TYPE_FACEBOOK = 'facebook';
    const TYPE_VK = 'vk';
    const TYPE_INSTAGRAM = 'instagram';
    const TYPE_ODNOKLASSNIKI = 'odnoklassniki';
    const TYPE_TELEGRAM = 'telegram';
    const TYPE_SKYPE = 'skype';
    const TYPE_VIBER = 'viber';
    const TYPE_WHATSUP = 'whats_up';

    const TYPE_LIST = [
        self::TYPE_PHONE,
        self::TYPE_EMAIL,
        self::TYPE_LINKEDIN,
        self::TYPE_FACEBOOK,
        self::TYPE_VK,
        self::TYPE_INSTAGRAM,
        self::TYPE_ODNOKLASSNIKI,
        self::TYPE_TELEGRAM,
        self::TYPE_SKYPE,
        self::TYPE_VIBER,
        self::TYPE_WHATSUP,
    ];

    private string $id;
    private Profile $profile;
    private string $type;
    private string $value;
    private bool $isPublic;
    private ?string $description;
    private string $profileId;

    protected function __construct()
    {
    }

    public static function create(
        string $id,
        Profile $profile,
        string $type,
        string $value,
        bool $isPublic = false,
        ?string $description = null
    ): self
    {
        Assert::uuid($id);
        Assert::oneOf($type, self::TYPE_LIST);
        Assert::lengthBetween($value, 1, 255);
        Assert::nullOrLengthBetween($description, 1, 255);

        $self = new self();
        $self->id = $id;
        $self->profile = $profile;
        $self->type = $type;
        $self->value = $value;
        $self->isPublic = $isPublic;
        $self->description = $description;

        return $self;
    }
}
