<?php

namespace App\Hrm\Common\Domain\Model;

abstract class StringAggregateId
{
    protected string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function equalsTo(StringAggregateId $stringAggregateId): bool
    {
        return $stringAggregateId->getId() === $this->getId();
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
