<?php

namespace App\CompanyBundle\Controller\Settings;

use App\CommonBundle\Service\GenerateIdentifier;
use App\CompanyBundle\Message\CreateCompany;
use App\CompanyBundle\Repository\CompanyRepository;
use App\CompanyBundle\Service\LogoFileSystem;
use App\CompanyBundle\Form\Type\CreateCompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MyCompanyController extends AbstractController
{
    public function index(
        Request $request,
        GenerateIdentifier $generateIdentifier,
        CompanyRepository $companyRepository,
        LogoFileSystem $logoFileSystem,
        ValidatorInterface $validator
    ): Response
    {
        $accountId = $this->getUser()->getUsername();

        $companyRequest = new CreateCompany();
        $companyRequest->creatorAccountId = $accountId;

        $company = $companyRepository->findOneBy(['createdBy' => $accountId]);
        if (null !== $company) {
            if (null !== $company->getLogoName()) {
                $companyRequest->logoFilePath = $logoFileSystem->getFullFilePath($company->getLogoName());
            }
            $companyRequest->name = $company->getName();
        }

        $violations = $validator->validate($request);

        $form = $this
            ->createForm(
                CreateCompanyType::class,
                $companyRequest,
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $companyRequest->id = $generateIdentifier->generate();

            $this->dispatchMessage($companyRequest);
        }

        return $this->render(
            '@Company/settings/my/index.html.twig',
            [
                'form' => $form->createView(),
                'isCompanyCreated' => null !== $company,
                'companyRequest' => $companyRequest,
            ]
        );
    }
}
