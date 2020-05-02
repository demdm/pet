<?php

namespace App\Hrm\Company\Command;

use App\Hrm\Common\Service\CommitTransaction;
use App\Hrm\Common\Service\GenerateIdentifier;
use App\Hrm\Company\Model\Company;
use App\Hrm\Company\Repository\CompanyRepository;
use App\Hrm\Identity\Model\Account;
use App\Hrm\Identity\Repository\AccountRepository;
use DateTimeImmutable;

class CreateCompanyHandler
{
    private GenerateIdentifier $generateIdentifier;
    private CommitTransaction $commitTransaction;
    private AccountRepository $accountRepository;
    private CompanyRepository $companyRepository;

    public function __construct(
        GenerateIdentifier $generateIdentifier,
        CommitTransaction $commitTransaction,
        AccountRepository $accountRepository,
        CompanyRepository $companyRepository
    ) {
        $this->generateIdentifier = $generateIdentifier;
        $this->commitTransaction = $commitTransaction;
        $this->accountRepository = $accountRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param CreateCompany $command
     * @throws
     */
    public function handle(CreateCompany $command): void
    {
        /** @var Account $creator */
        $creator = $this->accountRepository->get($command->creatorId);

        $nowDateTime = new DateTimeImmutable();

        // todo Do upload logo file image
        $logoPath = null;

        $company = Company::create(
            $command->id,
            $command->name,
            $creator,
            $nowDateTime,
            $logoPath
        );

        if (null !== $command->address) {
            $company->addOffice(
                $this->generateIdentifier->generate(),
                $command->address,
                $nowDateTime
            );
        }

        $this->companyRepository->add($company);

        $creator->appointAsCompanyOwner($company);

        $this->commitTransaction->commit();
    }
}
