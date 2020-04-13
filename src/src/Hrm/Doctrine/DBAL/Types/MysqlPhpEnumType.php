<?php

namespace App\Hrm\Doctrine\DBAL\Types;

use Acelaya\Doctrine\Type\PhpEnumType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class MysqlPhpEnumType extends PhpEnumType
{
    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $values = call_user_func([$this->enumClass, 'toArray']);

        return sprintf(
            'ENUM("%s")',
            implode('", "', $values)
        );
    }
}
