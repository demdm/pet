<?php

namespace App\IdentityBundle\Service;

interface HashPassword
{
    public function hash(string $plainPassword): string;
}
