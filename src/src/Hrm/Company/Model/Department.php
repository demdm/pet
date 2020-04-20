<?php

namespace App\Hrm\Company\Model;

use Webmozart\Assert\Assert;

final class Department
{
    private string $id;
    private string $name;
    private Company $company;
    private Employee $head;
    private ?string $description;
    private int $employeeCount;

    private function __construct()
    {
        $this->employeeCount = 0;
    }

    public static function create(
        string $id,
        string $name,
        Employee $head,
        Company $company,
        ?string $description = null
    ): self
    {
        Assert::uuid($id);
        Assert::lengthBetween($name, 1, 256);
        Assert::nullOrLengthBetween($description, 1, 256);

        $self = new self();
        $self->id = $id;
        $self->name = $name;
        $self->head = $head;
        $self->company = $company;
        $self->description = $description;

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
