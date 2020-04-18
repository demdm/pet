<?php

namespace App\Hrm\Common\Type;

class StringType
{
    use CompareType, LengthType;

    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function toString(): string
    {
        return $this->value;
    }
}
