<?php

namespace App\Hrm\Common\Type;

class StringType
{
    use CompareType, LengthType;

    protected string $value;

    public function __construct(
        string $value,
        ?int $lengthFrom = null,
        ?int $lengthTo = null
    ) {
        $this->value = $value;

        if (null !== $lengthFrom) {
            $this->setLengthFrom($lengthFrom);
        }

        if (null !== $lengthTo) {
            $this->setLengthTo($lengthTo);
        }
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
