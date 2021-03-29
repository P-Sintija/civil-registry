<?php

namespace App\Services;

use App\Models\PersonCollection;
use App\Repositories\PersonRepository;

class SearchPersonService
{
    private PersonRepository $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function search(string $key, string $value): PersonCollection
    {
        $foundPersons = new PersonCollection();
        if (strlen($value) > 0) {
            $foundPersons = $this->personRepository->search($key, $value);
        }
        return $foundPersons;
    }


}