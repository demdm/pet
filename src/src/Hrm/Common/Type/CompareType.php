<?php

namespace App\Hrm\Common\Type;

trait CompareType
{
    abstract public function getValue();

    public function compareWith(self $toCompareWithOne): bool
    {
        return $toCompareWithOne->getValue() === $this->getValue();
    }
}
