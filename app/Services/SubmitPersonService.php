<?php

namespace App\Services;


use App\Repositories\PersonRepository;


class SubmitPersonService
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

    public function save(StoreRequest $post): void
    {
        $this->personRepository->save($post);
    }


}