<?php
Namespace App\Services;

use App\Models\PersonCollection;
use App\Repositories\PersonRepository;

class PersonListService
{
    private PersonRepository $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function getPersonsList(): PersonCollection
    {
       return $this->personRepository->getPersonsList();
    }

}

