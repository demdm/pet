<?php

namespace App\IdentityBundle\Controller;

use App\CommonBundle\Service\GenerateIdentifier;
use App\IdentityBundle\Message\Registration;
use App\IdentityBundle\Form\Type\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class RegistrationController extends AbstractController
{
    public function index(
        Request $request,
        GenerateIdentifier $generateIdentifier
    ): Response
    {
        $registration = new Registration();

        $form = $this->createForm(
            RegistrationType::class,
            $registration,
            ['attr' => ['class' => 'form-signin']]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registration->uuid = $generateIdentifier->generate();

            $this->dispatchMessage($registration);
        }

        return $this->render(
            '@Identity/registration/index.html.twig',
            ['form' => $form->createView()]
        );
    }
}
