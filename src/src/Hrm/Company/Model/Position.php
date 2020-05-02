<?php

namespace App\Hrm\Company\Model;

use Webmozart\Assert\Assert;

final class Position
{
    private string $id;
    private string $name;
    private Company $company;
    private int $employeeCount;

    private function __construct()
    {
        $this->employeeCount = 0;
    }

    public static function create(
        string $id,
        string $name,
        Company $company
    ): self
    {
        Assert::uuid($id);
        Assert::lengthBetween($name, 1, 255);

        $self = new self();
        $self->id = $id;
        $self->name = $name;
        $self->company = $company;

        return $self;
    }

    public function increaseEmployeeCount(): void
    {
        $this->employeeCount += 1;
    }

    public function decreaseEmployeeCount(): void
    {
        $this->employeeCount -= 1;
    }
}
