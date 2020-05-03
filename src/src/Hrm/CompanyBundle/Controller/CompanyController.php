<?php

namespace App\Hrm\CompanyBundle\Controller;

use App\Hrm\Common\Service\GenerateIdentifier;
use App\Hrm\Company\Message\CreateCompany;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends AbstractController
{
    public function index(
        Request $request,
        GenerateIdentifier $generateIdentifier
    ): Response
    {
        $creatorAccountId = $request->get('account_id');
        $companyId = $generateIdentifier->generate();

        $createCompany = new CreateCompany(
            $creatorAccountId,
            $companyId,
            'Apple',
            'Los Angeles'
        );

        $this->dispatchMessage($createCompany, [

        ]);

        return new Response(
            'Company has been created! Company ID: ' . $companyId .'.'
        );
    }
}
