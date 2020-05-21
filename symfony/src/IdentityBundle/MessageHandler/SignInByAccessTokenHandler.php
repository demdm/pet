<?php

namespace App\IdentityBundle\MessageHandler;

use App\IdentityBundle\Entity\AccessToken;
use App\IdentityBundle\Message\SignInByAccessToken;
use App\IdentityBundle\Repository\AccessTokenRepository;
use App\IdentityBundle\Repository\AccountRepository;

class SignInByAccessTokenHandler
{
    private AccountRepository $accountRepository;
    private AccessTokenRepository $accessTokenRepository;

    public function __construct(
        AccountRepository $accountRepository,
        AccessTokenRepository $accessTokenRepository
    ) {
        $this->accountRepository = $accountRepository;
        $this->accessTokenRepository = $accessTokenRepository;
    }

    public function __invoke(SignInByAccessToken $message): void
    {
        $account = $this->accountRepository->getOneBy(['email' => $message->email]);

        $accessToken = new AccessToken($account, $message->accessToken);

        $this->accessTokenRepository->add($accessToken);
    }
}
