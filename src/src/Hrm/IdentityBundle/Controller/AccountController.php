<?php

namespace App\Hrm\IdentityBundle\Controller;

use App\Hrm\Identity\Application\Query\Account\FindOneQuery;
use App\Hrm\Identity\Application\Query\Account\FindOneRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class AccountController
{
    public function index(FindOneQuery $findAccountQuery)
    {
        $findAccountRequest = new FindOneRequest('cb71cce9-e0c9-402d-8772-e5a23750945e');

        $account = $findAccountQuery->handle($findAccountRequest);

        return JsonResponse::create(
            $account
        );
    }
}
