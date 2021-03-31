<?php

namespace App\Controllers;


use App\Services\EditPersonService;
use App\Services\SearchPersonService;
use App\Services\StoreRequest;
use App\Validations\ExportPersonValidation;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

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
        $person = array_shift($person);

        $loader = new FilesystemLoader('Views');
        $twig = new Environment($loader);

        echo $twig->render('edit.html', [
            'name' => $person->getName(),
            'surname' => $person->getSurname(),
            'personalId' => $person->getPersonalId(),
            'age' => $person->getAge(),
            'address' => $person->getAddress(),
            'personality' => $person->getPersonality()
        ]);

    }


    public function editPerson(): void
    {
        $person = $this->searchService->search(key($_GET), $_GET[key($_GET)])->getPersonData();

        $person = array_shift($person);

        $request = new StoreRequest(
            $_POST['name'],
            $_POST['surname'],
            $_POST['personalId'],
            $_POST['age'],
            $_POST['address'],
            $_POST['personality']);

        $personExists = $this->editService->getRepository()->checkPersonExists($request);

        $validation = new ExportPersonValidation();
        if ($validation->validatePost($request) &&
            (!$personExists || ($_POST['personalId'] === $person->getPersonalId()))) {
            $this->editService->editPersonData($person, $request);
        }
        header('Location:/');
    }

}


