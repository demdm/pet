<?php

namespace App\Hrm\Common\Domain\Model;

use Webmozart\Assert\Assert;

class Email
{
    protected string $email;

    public function __construct(string $email)
    {
        Assert::email($email);

        $this->email = $email;
    }

    public function getId(): string
    {
        return $this->email;
    }

    public function equalsTo(StringAggregateId $stringAggregateId): bool
    {
        return $stringAggregateId->getId() === $this->getId();
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
