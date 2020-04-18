<?php

namespace App\Hrm\IdentityBundle\Controller;

use App\Hrm\Common\Domain\Service\IdGenerator;
use App\Hrm\Identity\Application\Service\Registration\CreateRequest;
use App\Hrm\Identity\Application\Service\Registration\CreateService;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController
{
    public function index(
        CreateService $registrationService,
        IdGenerator $idGenerator
    ): Response
    {
        $userId = $idGenerator->generate();

        $registrationRequest = new CreateRequest(
            $userId,
            'Dima',
            'Demianov',
            'd65950@gmail.com2',
            'qwerty'
        );

        $registrationService->handle($registrationRequest);

        return new Response(
            'Registration have been done! User ID: ' . $userId .'.'
        );
    }
}
