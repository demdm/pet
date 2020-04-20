<?php

namespace App\Hrm\Company\Model;

use App\Hrm\Identity\Model\Account;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Webmozart\Assert\Assert;

final class Employee
{
    private string $id;
    private Account $account;
    private Company $company;
    private ?Office $office;
    private bool $isWorkingRemotely;
    private Department $department;
    private Position $position;
    private bool $isPending;
    private bool $isActive;
    private bool $isHired;
    private bool $isFired;
    private ?DateTimeInterface $hiredAt;
    private ?DateTimeInterface $firedAt;

    /**
     * @var Department[]|ArrayCollection
     */
    private $headOfDepartmentList;

    private function __construct()
    {
        $this->headOfDepartmentList = new ArrayCollection();
    }

    // creation by an employee himself
    public static function createByHimself(
        string $id,
        Account $account,
        Company $company,
        Department $department,
        Position $position,
        ?Office $office = null
    ): self
    {
        Assert::uuid($id);

        $self = new self();
        $self->id = $id;
        $self->account = $account;
        $self->company = $company;
        $self->department = $department;
        $self->position = $position;
        $self->office = $office;

        $self->isPending = true;
        $self->isWorkingRemotely = false;
        $self->isActive = false;
        $self->isHired = false;
        $self->isFired = false;

        return $self;
    }
}
