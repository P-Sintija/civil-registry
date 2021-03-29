<?php

namespace App\Services;

use App\Models\Person;
use App\Repositories\PersonRepository;

class EditPersonService
{
    private PersonRepository $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }


    public function getRepository(): PersonRepository
    {
        return $this->personRepository;
    }

    public function editPersonData(Person $person, StoreRequest $post): void
    {
        $this->personRepository->edit($person, $post);
    }

}

