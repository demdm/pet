<?php

namespace App\Hrm\Common\Domain\Service;

interface IdGenerator
{
    public function generate(): string;
}
