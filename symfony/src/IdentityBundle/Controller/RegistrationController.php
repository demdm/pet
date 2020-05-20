<?php

namespace App\IdentityBundle\Controller;

use App\CommonBundle\Controller\Response;
use App\CommonBundle\Service\GenerateIdentifier;
use App\IdentityBundle\Message\Registration;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class RegistrationController
{
    public function index(
        Request $request,
        GenerateIdentifier $generateIdentifier,
        MessageBusInterface $bus,
        ValidatorInterface $validator,
        NormalizerInterface $normalizer
    ): JsonResponse
    {
        $registration = new Registration();
        $registration->name = $request->get('name');
        $registration->email = $request->get('email');
        $registration->password = $request->get('password');

        $violations = $validator->validate($registration);

        if ($violations->count() > 0) {
            $response = Response::failure($normalizer->normalize($violations));
        } else {
            $registration->uuid = $generateIdentifier->generate();
            $bus->dispatch($registration);
            $response = Response::success();
        }

        return JsonResponse::create($response);
    }
}
