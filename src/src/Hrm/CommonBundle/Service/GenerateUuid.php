<?php

namespace App\Hrm\CommonBundle\Service;

use App\Hrm\Common\Service\GenerateIdentifier;
use Ramsey\Uuid\Uuid;

class GenerateUuid implements GenerateIdentifier
{
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
