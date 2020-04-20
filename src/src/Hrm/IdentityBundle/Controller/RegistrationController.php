<?php

namespace App\Hrm\IdentityBundle\Controller;

use App\Hrm\Common\Service\GenerateIdentifier;
use App\Hrm\Identity\Facade\Registration;
use App\Hrm\Identity\Facade\RegistrationRequest;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController
{
    public function index(
        Registration $registration,
        GenerateIdentifier $generateIdentifier
    ): Response
    {
        $userId = $generateIdentifier->generate();

        $registrationRequest = new RegistrationRequest(
            $userId,
            'Dima',
            'Demianov',
            'd65950@gmail.com2',
            'qwerty'
        );

        $registration->handle($registrationRequest);

        return new Response(
            'Registration have been done! User ID: ' . $userId .'.'
        );
    }
}
