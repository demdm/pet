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
        // $userId = $generateIdentifier->generate();
        $userId = '4e9a88c0-7e67-42c7-8897-a5b74f5b10ac';

        $registration = new Registration(
            $userId,
            'Dima',
            'Demianov',
            'd65950@gmail.com',
            'qwerty'
        );

        $registrationHandler->handle($registration);

        return new Response(
            'Registration have been done! User ID: ' . $userId .'.'
        );
    }
}
