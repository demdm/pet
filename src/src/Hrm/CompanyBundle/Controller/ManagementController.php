<?php

namespace App\Hrm\CompanyBundle\Controller;

use App\Hrm\Common\Service\GenerateIdentifier;
use App\Hrm\Company\Message\CreateCompany;
use App\Hrm\CompanyBundle\Form\Type\CreateCompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagementController extends AbstractController
{
    public function index(
        Request $request,
        GenerateIdentifier $generateIdentifier
    ): Response
    {
        $createCompany = new CreateCompany();

        $createCompanyForm = $this
            ->createForm(
                CreateCompanyType::class,
                $createCompany,
            )
            ->handleRequest($request);

        if ($createCompanyForm->isSubmitted() && $createCompanyForm->isValid()) {
            $createCompany->creatorAccountId = $this->getUser()->getUsername();
            $createCompany->id = $generateIdentifier->generate();

            // todo: обернуть в транзакцию
            $this->dispatchMessage($createCompany, []);
        }

        return $this->render(
            '@HrmCompany/create/index.html.twig',
            [
                'createCompanyForm' => $createCompanyForm->createView(),
            ]
        );
    }
}
