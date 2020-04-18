<?php

namespace App\Hrm\Common\Type;

class ArrayType
{
    use CompareType, LengthType;

    protected array $value;

    public function __construct(array $value)
    {
        $this->value = $value;
    }

    final public function getValue(): array
    {
        return $this->value;
    }

    public function toArray(): array
    {
        return $this->getValue();
    }
}
