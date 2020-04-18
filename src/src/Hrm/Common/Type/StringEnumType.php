<?php

namespace App\Hrm\Common\Type;

use ReflectionClass;
use Webmozart\Assert\Assert;

class StringEnumType extends StringType
{
    public function __construct(string $value)
    {
        $enumList = (new ReflectionClass(static::class))->getConstants();
        Assert::notEmpty($enumList);
        Assert::true(in_array($value, $enumList, true));

        parent::__construct($value);
    }
}
