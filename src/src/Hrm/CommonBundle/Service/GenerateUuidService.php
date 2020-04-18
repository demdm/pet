<?php

namespace App\Hrm\CommonBundle\Service;

use App\Hrm\Common\Service\GenerateIdentifierService;
use Ramsey\Uuid\Uuid;

class GenerateUuidService implements GenerateIdentifierService
{
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
