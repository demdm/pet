<?php

namespace App\CommonBundle\Service;

use Ramsey\Uuid\Uuid;

class GenerateUuid implements GenerateIdentifier
{
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
