<?php

namespace App\Hrm\Common\Type;

class String1_256Type extends StringType
{
    protected string $value;

    public function __construct(string $value)
    {
        parent::__construct($value);

        $this
            ->setLengthFrom(1)
            ->setLengthTo(256);
    }
}
