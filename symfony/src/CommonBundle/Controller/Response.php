<?php

namespace App\CommonBundle\Controller;

class Response
{
    public bool $isSuccess;
    public array $violations = [];

    public static function success(): self
    {
        $self = new static();

        $self->isSuccess = true;

        return $self;
    }

    public static function failure(array $violations = []): self
    {
        $self = new static();

        $self->isSuccess = false;
        $self->violations = $violations;

        return $self;
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }
}
