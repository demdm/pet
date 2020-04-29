<?php

namespace App\Hrm\IdentityBundle\Controller;

use App\Hrm\Common\Service\GenerateIdentifier;
use App\Hrm\Identity\Command\RegistrationHandler;
use App\Hrm\Identity\Command\Registration;
use App\Hrm\IdentityBundle\Form\Type\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends AbstractController
{
    public function index(
        Request $request,
        RegistrationHandler $registrationHandler,
        GenerateIdentifier $generateIdentifier
    ): Response
    {
        $registration = new Registration();

        $form = $this->createForm(
            RegistrationType::class,
            $registration
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registration->uuid = $generateIdentifier->generate();
            $registrationHandler->handle($registration);
        }

        return $this->render(
            '@HrmIdentity/registration/index.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
