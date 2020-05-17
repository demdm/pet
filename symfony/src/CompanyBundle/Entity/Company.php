<?php

namespace App\CompanyBundle\Entity;

use App\IdentityBundle\Entity\Account;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Webmozart\Assert\Assert;

final class Company
{
    private string $id;
    private string $name;
    private Account $createdBy;
    private ?string $logoName;
    private DateTimeImmutable $createdAt;

    /** @var Account[]|ArrayCollection */
    private $ownerList;

    /** @var Office[]|ArrayCollection */
    private $officeList;

    /** @var Office[]|ArrayCollection */
    private $positionList;

    /** @var Department[]|ArrayCollection */
    private $departmentList;

    /** @var Employee[]|ArrayCollection */
    private $employeeList;

    private function __construct()
    {
        $this->ownerList = new ArrayCollection();
        $this->officeList = new ArrayCollection();
        $this->positionList = new ArrayCollection();
        $this->departmentList = new ArrayCollection();
        $this->employeeList = new ArrayCollection();
    }

    public static function create(
        string $id,
        string $name,
        Account $createdBy,
        DateTimeImmutable $createdAt,
        ?string $logoName = null
    ): self
    {
        Assert::uuid($id);
        Assert::lengthBetween($name, 1, 255);
        Assert::nullOrLengthBetween($logoName, 1, 255);

        $self = new self();
        $self->id = $id;
        $self->name = $name;
        $self->ownerList->add($createdBy);
        $self->createdBy = $createdBy;
        $self->createdAt = $createdAt;
        $self->logoName = $logoName;

        return $self;
    }

    public function addOffice(
        string $id,
        string $address,
        DateTimeImmutable $createdAt
    ): void
    {
        $office = Office::create(
            $id,
            $this,
            $address,
            $createdAt
        );

        $this->officeList->add($office);
    }

    public function addPosition(
        string $id,
        string $name
    ): void
    {
        $position = Position::create(
            $id,
            $name,
            $this
        );

        $this->positionList->add($position);
    }

    public function addDepartment(
        string $id,
        string $name,
        Employee $head,
        ?string $description = null
    ): void
    {
        $position = Department::create(
            $id,
            $name,
            $head,
            $this,
            $description
        );

        $this->departmentList->add($position);
    }

    public function addEmployee(
        string $id,
        string $name,
        Employee $head,
        ?string $description = null
    ): void
    {
        $position = Employee::create(
            $id,
            $name,
            $head,
            $this,
            $description
        );

        $this->departmentList->add($position);
    }

    /**
     * @return Account[]
     */
    public function getOwnerList(): array
    {
        return $this->ownerList->toArray();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getLogoName(): ?string
    {
        return $this->logoName;
    }

    /**
     * @return Office[]|ArrayCollection
     */
    public function getOfficeList()
    {
        return $this->officeList;
    }
}
