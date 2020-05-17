<?php

namespace App\CompanyBundle\Entity;

use DateTimeImmutable;
use Webmozart\Assert\Assert;

final class EmployeeRequest
{
    public const RESOLVED_STATUS_PENDING = 'pending';
    public const RESOLVED_STATUS_APPROVED = 'approved';
    public const RESOLVED_STATUS_REJECTED = 'rejected';

    protected string $id;
    protected string $companyId;
    protected string $employeeAccountId;
    protected ?string $resolverAccountId;
    protected string $resolvedStatus;
    protected DateTimeImmutable $createdAt;
    protected ?DateTimeImmutable $resolvedAt;

    private function __construct()
    {
    }

    public static function createByEmployee(
        string $id,
        string $companyId,
        string $employeeAccountId,
        DateTimeImmutable $createdAt
    ): self
    {
        Assert::uuid($id);
        Assert::uuid($companyId);
        Assert::uuid($employeeAccountId);

        $self = new self();
        $self->id = $id;
        $self->companyId = $companyId;
        $self->employeeAccountId = $employeeAccountId;
        $self->createdAt = $createdAt;
        $self->resolvedStatus = self::RESOLVED_STATUS_PENDING;

        return $self;
    }

    public function resolve(
        string $resolverAccountId,
        string $resolvedStatus,
        DateTimeImmutable $resolvedAt
    ): self
    {
        Assert::uuid($resolverAccountId);
        Assert::oneOf($resolvedStatus, [
            self::RESOLVED_STATUS_APPROVED,
            self::RESOLVED_STATUS_REJECTED,
        ]);

        $this->resolverAccountId = $resolverAccountId;
        $this->resolvedStatus = $resolvedStatus;
        $this->resolvedAt = $resolvedAt;

        return $this;
    }
}
