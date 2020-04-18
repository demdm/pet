<?php

namespace App\Hrm\Identity\Account\Service;

interface HashPasswordService
{
    public function hash(string $plainPassword): string;
}
