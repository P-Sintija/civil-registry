<?php

namespace App\Controllers;

//use App\Models\PersonAdmin;
//use App\Models\PersonCollection;


use App\Models\PersonCollection;
use App\Services\SearchPersonService;
use App\Validations\RequestValidation;

class SearchController
{
    private SearchPersonService $service;

    public function __construct(SearchPersonService $service)
    {
        $this->service = $service;
    }

    public function showPage(): void
    {
        require_once __DIR__ . '/../../public/Views/search.php';
    }

    public function searchPerson(): void
    {
        $foundPersons = new PersonCollection();
        $validation = new RequestValidation();

        if ($validation->ifPostPresent($_POST)) {
            if ($validation->validatePersonIdKey(key($_POST))) {
                $_POST[key($_POST)] = str_replace('-', '', $_POST[key($_POST)]);
            }

            $foundPersons = $this->service->search(key($_POST), $_POST[key($_POST)]);
        }

        require_once __DIR__ . '/../../public/Views/search.php';
    }

}


