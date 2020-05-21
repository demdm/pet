<?php

namespace App\IdentityBundle\Entity;

final class AccessToken
{
    private int $id;
    private Account $account;
    private string $accessToken;

    public function __construct(Account $account, string $accessToken)
    {
        $this->account = $account;
        $this->accessToken = $accessToken;
    }

    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}
