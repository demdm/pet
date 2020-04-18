<?php

namespace App\Hrm\Common\Type;

use Webmozart\Assert\Assert;

trait LengthType
{
    protected int $lengthFrom;
    protected int $lengthTo;

    abstract public function getValue();

    public function setLengthFrom(int $lengthFrom): self
    {
        Assert::minLength($this->getValue(), $lengthFrom);

        $this->lengthFrom = $lengthFrom;

        return $this;
    }

    public function setLengthTo(int $lengthTo): self
    {
        Assert::maxLength($this->getValue(), $lengthTo);

        $this->lengthTo = $lengthTo;

        return $this;
    }
}
