<?php

namespace App\Hrm\Identity\Domain\Service\Account;

interface AccountPasswordHasher
{
    public function hash(string $plainPassword): string ;
}
