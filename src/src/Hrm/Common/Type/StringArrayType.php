<?php

namespace App\Hrm\Common\Type;

use Webmozart\Assert\Assert;

class StringArrayType extends ArrayType
{
    public function __construct(array $value)
    {
        foreach ($value as $string) {
            Assert::string($string);
        }

        parent::__construct($value);
    }
}
