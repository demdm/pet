<?php

namespace App\Hrm\Identity\Service;

interface HashPassword
{
    public function hash(string $plainPassword): string;
}
