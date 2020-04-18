<?php

namespace App\Hrm\IdentityBundle\Controller;

use App\Hrm\Common\Service\GenerateIdentifierService;
use App\Hrm\Identity\Account\Facade\CreateFacade;
use App\Hrm\Identity\Account\Facade\CreateFacadeRequest;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController
{
    public function index(
        CreateFacade $createAccountService,
        GenerateIdentifierService $generateIdentifierService
    ): Response
    {
        $userId = $generateIdentifierService->generate();

        $registrationRequest = new CreateFacadeRequest(
            $userId,
            'Dima',
            'Demianov',
            'd65950@gmail.com',
            'qwerty'
        );

        $createAccountService->handle($registrationRequest);

        return new Response(
            'Registration have been done! User ID: ' . $userId .'.'
        );
    }
}
