<?php

namespace App\Hrm\Common\Application\Service;

interface UnitOfWork
{
    public function commit(): void;
}
