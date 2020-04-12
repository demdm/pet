<?php

namespace App\Hrm\Common\Infrastructure\Domain\Service;

use App\Hrm\Common\Domain\Service\IdGenerator;
use Ramsey\Uuid\Uuid;

class UuidGenerator implements IdGenerator
{
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
