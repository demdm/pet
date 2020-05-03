<?php

namespace App\Hrm\Company\MessageHandler;

use App\Hrm\Common\Service\GenerateIdentifier;
use App\Hrm\Company\Message\CreateCompany;
use App\Hrm\Company\Model\Company;
use App\Hrm\Company\Repository\CompanyRepository;
use App\Hrm\Identity\Repository\AccountRepository;
use DateTimeImmutable;

class CreateCompanyHandler
{
    private GenerateIdentifier $generateIdentifier;
    private AccountRepository $accountRepository;
    private CompanyRepository $companyRepository;

    public function __construct(
        GenerateIdentifier $generateIdentifier,
        AccountRepository $accountRepository,
        CompanyRepository $companyRepository
    ) {
        $this->generateIdentifier = $generateIdentifier;
        $this->accountRepository = $accountRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @todo Wrap into a transaction
     *
     * @param CreateCompany $command
     * @throws
     */
    public function __invoke(CreateCompany $command): void
    {
        $creatorAccount = $this->accountRepository->get($command->creatorAccountId);

        $nowDateTime = new DateTimeImmutable();

        // todo Do upload logo file image
        $logoPath = null;

        $company = Company::create(
            $command->id,
            $command->name,
            $creatorAccount,
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

        $creatorAccount->appointAsCompanyOwner($company);
    }
}
