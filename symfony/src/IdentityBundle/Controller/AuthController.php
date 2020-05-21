<?php

namespace App\IdentityBundle\Controller;

use App\CommonBundle\Controller\Response;
use App\CommonBundle\Service\GenerateIdentifier;
use App\IdentityBundle\Message\SignInByAccessToken;
use App\IdentityBundle\Service\ValidatePassword;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class AuthController
{
    public function signIn(
        Request $request,
        GenerateIdentifier $generateIdentifier,
        ValidatePassword $validatePassword,
        MessageBusInterface $bus,
        ValidatorInterface $validator,
        NormalizerInterface $normalizer
    ) {
        $accessToken = $generateIdentifier->generate();

        $signInByAccessToken = new SignInByAccessToken(
            $accessToken,
            $request->get('email', ''),
            $request->get('password', '')
        );

        $violations = $validator->validate($signInByAccessToken);

        if ($violations->count() > 0) {
            return JsonResponse::create(Response::failure($normalizer->normalize($violations)));
        }

        $isPasswordValid = $validatePassword->validate(
            $signInByAccessToken->email,
            $signInByAccessToken->password
        );

        // password not valid
        if (!$isPasswordValid) {
            $violations->add(
                new ConstraintViolation(
                    'Не верный пароль',
                    '',
                    array(),
                    null,
                    'password',
                    null
                )
            );

            return JsonResponse::create(Response::failure($normalizer->normalize($violations)));
        }

        $bus->dispatch($signInByAccessToken);

        return JsonResponse::create(Response::success([
            'token' => $accessToken
        ]));
    }
}
