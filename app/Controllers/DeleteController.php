<?php

namespace App\Controllers;

use App\Services\DeletePersonService;

class DeleteController
{
    private DeletePersonService $service;

    public function __construct(DeletePersonService $service)
    {
        $this->service = $service;
    }

    public function deletePerson(): void
    {
        if (key($_POST) === 'personalId') {
            $this->service->deletePerson(key($_POST), $_POST[key($_POST)]);
        }
        header('Location:/');
    }

}

