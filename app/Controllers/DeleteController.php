<?php

namespace App\Controllers;

use App\Services\DeletePersonService;
use App\Validations\RequestValidation;

class DeleteController
{
    private DeletePersonService $service;

    public function __construct(DeletePersonService $service)
    {
        $this->service = $service;
    }

    public function deletePerson(): void
    {
        $validation = new RequestValidation();
        if ($validation->validatePersonIdKey(key($_POST))) {
            $this->service->deletePerson(key($_POST), $_POST[key($_POST)]);
        }
        header('Location:/');
    }

}

