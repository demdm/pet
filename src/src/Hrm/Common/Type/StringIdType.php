<?php

namespace App\Hrm\Common\Type;

class StringIdType extends StringType
{
    public function __construct(
        string $value,
        ?int $lengthFrom = null,
        ?int $lengthTo = null
    ) {


        parent::__construct(
            $value,
            $lengthFrom,
            $lengthTo
        );
    }
}
