<?php

namespace App\Hrm\CompanyBundle\Controller\Settings;

use App\Hrm\Common\Service\GenerateIdentifier;
use App\Hrm\Company\Message\CreateCompany;
use App\Hrm\Company\Repository\CompanyRepository;
use App\Hrm\Company\Service\LogoFileSystem;
use App\Hrm\CompanyBundle\Form\Type\CreateCompanyType;
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
            '@HrmCompany/settings/my/index.html.twig',
            [
                'form' => $form->createView(),
                'isCompanyCreated' => null !== $company,
                'companyRequest' => $companyRequest,
            ]
        );
    }
}
