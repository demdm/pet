<?php

namespace App\CompanyBundle\MessageHandler;

use App\CommonBundle\Service\GenerateIdentifier;
use App\CompanyBundle\Message\CreateCompany;
use App\CompanyBundle\Entity\Company;
use App\CompanyBundle\Repository\CompanyRepository;
use App\CompanyBundle\Service\LogoFileSystem;
use App\IdentityBundle\Repository\AccountRepository;
use DateTimeImmutable;

class CreateCompanyHandler
{
    private GenerateIdentifier $generateIdentifier;
    private AccountRepository $accountRepository;
    private CompanyRepository $companyRepository;
    private LogoFileSystem $logoFileSystem;

    public function __construct(
        GenerateIdentifier $generateIdentifier,
        AccountRepository $accountRepository,
        CompanyRepository $companyRepository,
        LogoFileSystem $logoFileSystem
    ) {
        $this->generateIdentifier = $generateIdentifier;
        $this->accountRepository = $accountRepository;
        $this->companyRepository = $companyRepository;
        $this->logoFileSystem = $logoFileSystem;
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

        if ($command->logoFile) {
            $logoName = $this->logoFileSystem->write($command->logoFile);
        } else {
            $logoName = null;
        }

        $company = Company::create(
            $command->id,
            $command->name,
            $creatorAccount,
            $nowDateTime,
            $logoName
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
