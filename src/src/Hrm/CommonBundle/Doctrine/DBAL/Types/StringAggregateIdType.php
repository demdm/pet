<?php

namespace App\Hrm\CommonBundle\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

abstract class StringAggregateIdType extends Type
{
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    public function getDefaultLength(AbstractPlatform $platform)
    {
        return $platform->getVarcharDefaultLength();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value || is_subclass_of($value, $this->getClassName())) {
            return $value;
        }

        $className = $this->getClassName();

        return new $className($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        if (is_subclass_of($value, $this->getClassName()) ||
            is_string($value) ||
            method_exists($value, '__toString')
        ) {
            return (string) $value;
        }

        throw ConversionException::conversionFailed($value, $this->getClassName());
    }

    abstract protected function getClassName();
}
