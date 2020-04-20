<?php

namespace App\Hrm\CompanyBundle\Controller;

use App\Hrm\Common\Service\GenerateIdentifier;
use App\Hrm\Company\Command\CreateCompany;
use App\Hrm\Company\Command\CreateCompanyHandler;
use Symfony\Component\HttpFoundation\Response;

class CompanyController
{
    public function index(
        CreateCompanyHandler $createCompanyHandler,
        GenerateIdentifier $generateIdentifier
    ): Response
    {
        $creatorId = '4e9a88c0-7e67-42c7-8897-a5b74f5b10ac';
        $companyId = $generateIdentifier->generate();

        $createCompany = new CreateCompany(
            $creatorId,
            $companyId,
            'Apple',
            'Los Angeles'
        );

        $createCompanyHandler->handle($createCompany);

        return new Response(
            'Company has been created! Company ID: ' . $companyId .'.'
        );
    }
}
