<?php

namespace App\Hrm\IdentityBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class RegistrationController
{
    public function index()
    {
        return new Response('Registration');
    }
}
