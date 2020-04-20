<?php

namespace App\Hrm\Company\Model;

use DateTimeImmutable;
use Webmozart\Assert\Assert;

final class Office
{
    private string $id;
    private Company $company;
    private string $address;
    private DateTimeImmutable $createdAt;

    private function __construct()
    {
    }

    public static function create(
        string $id,
        Company $company,
        string $address,
        DateTimeImmutable $createdAt
    ): self
    {
        Assert::uuid($id);
        Assert::lengthBetween($address, 1, 256);

        $self = new self();
        $self->id = $id;
        $self->company = $company;
        $self->address = $address;
        $self->createdAt = $createdAt;

        return $self;
    }
}
