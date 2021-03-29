<?php

namespace App\Services;

use App\Repositories\PersonRepository;

class DeletePersonService
{
    private PersonRepository $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function deletePerson(string $key, string $value): void
    {
        $this->personRepository->delete($key, $value);
    }

}

