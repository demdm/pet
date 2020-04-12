<?php

namespace App\Hrm\CommonBundle\Doctrine\DBAL\Types;

use App\Hrm\Common\Domain\Model\Email;

class EmailType extends StringAggregateIdType
{
    const NAME = 'email';

    protected function getClassName(): string
    {
        return Email::class;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
