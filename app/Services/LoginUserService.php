<?php
namespace App\Services;

use App\Models\PersonCollection;
use App\Repositories\MySQLTokenRepository;
use App\Repositories\PersonRepository;

class LoginUserService
{
    private PersonRepository $personRepository;
    private MySQLTokenRepository $tokenRepository;

    public function __construct(PersonRepository $personRepository, MySQLTokenRepository $tokenRepository)
    {
        $this->personRepository = $personRepository;
        $this->tokenRepository = $tokenRepository;
    }

    public function successfulLogin(string $token): bool
    {
        return $this->tokenRepository->tokenExists($token) &&
            time() < $this->tokenRepository->searchPersonalId($token)->getTime();
    }

    public function userInfo(string $token): PersonCollection
    {
        $id = $this->findPersonalId($token);
        return $this->personRepository->search('personalId', $id);
    }

    private function findPersonalId(string $id): string
    {
        return $this->tokenRepository->searchPersonalId($id)->getPersonalId();
    }

}

