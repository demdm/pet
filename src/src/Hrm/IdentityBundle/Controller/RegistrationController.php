<?php

namespace App\Hrm\IdentityBundle\Controller;

use App\Hrm\Common\Service\GenerateIdentifier;
use App\Hrm\Identity\Command\RegistrationHandler;
use App\Hrm\Identity\Command\Registration;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController
{
    public function index(
        RegistrationHandler $registrationHandler,
        GenerateIdentifier $generateIdentifier
    ): Response
    {
        $userId = $generateIdentifier->generate();

        $registration = new Registration(
            $userId,
            'Dima',
            'Demianov',
            'd65950@gmail.com3',
            'qwerty'
        );

        $registrationHandler->handle($registration);

        return new Response(
            'Registration have been done! User ID: ' . $userId .'.'
        );
    }
}
