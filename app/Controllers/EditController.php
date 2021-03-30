<?php

namespace App\Controllers;


use App\Services\EditPersonService;
use App\Services\SearchPersonService;
use App\Services\StoreRequest;
use App\Validations\ExportPersonValidation;

class EditController
{
    private EditPersonService $editService;
    private SearchPersonService $searchService;

    public function __construct(EditPersonService $editService, SearchPersonService $searchService)
    {
        $this->editService = $editService;
        $this->searchService = $searchService;
    }

    public function showPage(): void
    {
        $person = $this->searchService->search(key($_GET), $_GET[key($_GET)])->getPersonData();

        require_once __DIR__ . '/../../public/Views/edit.php';
    }


    public function editPerson(): void
    {
        $person = $this->searchService->search(key($_GET), $_GET[key($_GET)])->getPersonData();

        $person = array_shift($person);

        $request = new StoreRequest($_POST['name'], $_POST['surname'], $_POST['personalId'], $_POST['personality']);

        $personExists = $this->editService->getRepository()->checkPersonExists($request);

        $validation = new ExportPersonValidation();
        if ($validation->validatePost($_POST) &&
            (!$personExists || ($_POST['personalId'] === $person->getPersonalId()))) {
            $this->editService->editPersonData($person, $request);
        }
        header('Location:/');
    }

}


