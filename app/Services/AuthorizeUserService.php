<?php

namespace App\Services;


use App\Models\PersonCollection;
use App\Repositories\PersonRepository;
use App\Repositories\TokenRepository;

class AuthorizeUserService
{

    private PersonRepository $personRepository;
    private TokenRepository $tokenRepository;

    public function __construct(PersonRepository $personRepository, TokenRepository $tokenRepository)
    {
        $this->personRepository = $personRepository;
        $this->tokenRepository = $tokenRepository;
    }

    public function searchPerson(string $key, string $value): PersonCollection
    {
        $user = new PersonCollection();
        $user = $this->personRepository->search($key, $value);
        return $user;
    }

    public function createToken(string $personalId): string
    {
        $password = password_hash($personalId, PASSWORD_BCRYPT);
        $this->tokenRepository->createToken($personalId, $password);
        return $password;
    }

}