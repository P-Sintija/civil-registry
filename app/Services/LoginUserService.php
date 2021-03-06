<?php

namespace App\Services;

use App\Models\PersonCollection;
use App\Repositories\PersonRepository;
use App\Repositories\TokenRepository;

class LoginUserService
{
    private PersonRepository $personRepository;
    private TokenRepository $tokenRepository;

    public function __construct(PersonRepository $personRepository, TokenRepository $tokenRepository)
    {
        $this->personRepository = $personRepository;
        $this->tokenRepository = $tokenRepository;
    }

    public function successfulLogin(string $token): bool
    {
        return $this->tokenRepository->tokenExists($token) &&
            time() < $this->tokenRepository->searchPersonalId($token)->getTime();
    }

    public function userInfo(int $Id): PersonCollection
    {
        return $this->personRepository->search('ID', $Id);
    }

    public function LogOutUser(array $var): void
    {
        $this->tokenRepository->delete((int)$var['id']);
    }

}

