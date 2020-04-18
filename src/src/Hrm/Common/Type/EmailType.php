<?php

namespace App\Hrm\Common\Type;

use Webmozart\Assert\Assert;

class EmailType extends StringType
{
    protected string $value;

    public function __construct(string $value)
    {
        Assert::email($value);

        parent::__construct($value);
    }
}
