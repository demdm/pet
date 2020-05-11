<?php

namespace App\Hrm\CompanyBundle\Controller\Settings;

use App\Hrm\Common\Service\GenerateIdentifier;
use App\Hrm\Company\Message\CreateCompany;
use App\Hrm\CompanyBundle\Form\Type\CreateCompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateController extends AbstractController
{
    public function index(
        Request $request,
        GenerateIdentifier $generateIdentifier
    ): Response
    {
        $createCompany = new CreateCompany();

        $form = $this
            ->createForm(
                CreateCompanyType::class,
                $createCompany,
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $createCompany->creatorAccountId = $this->getUser()->getUsername();
            $createCompany->id = $generateIdentifier->generate();

            // todo: обернуть в транзакцию
            $this->dispatchMessage($createCompany, []);
        }

        return $this->render(
            '@HrmCompany/settings/create/index.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
