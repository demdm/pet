<?php

namespace App\Hrm\IdentityBundle\Controller;

use App\Hrm\Common\Service\GenerateIdentifier;
use App\Hrm\Identity\Message\Registration;
use App\Hrm\IdentityBundle\Form\Type\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

final class RegistrationController extends AbstractController
{
    public function index(
        Request $request,
        MessageBusInterface $messageBus,
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

            $messageBus->dispatch($registration);
        }

        return $this->render(
            '@HrmIdentity/registration/index.html.twig',
            ['form' => $form->createView()]
        );
    }
}
