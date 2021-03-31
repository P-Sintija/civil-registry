<?php

namespace App\Controllers;

use App\Models\PersonCollection;
use App\Services\SearchPersonService;
use App\Validations\RequestValidation;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class SearchController
{
    private SearchPersonService $service;

    public function __construct(SearchPersonService $service)
    {
        $this->service = $service;
    }

    public function showPage(): void
    {
        $loader = new FilesystemLoader('Views');
        $twig = new Environment($loader);

        echo $twig->render('search.html', [
            'post' => $_POST,
        ]);

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

        $this->showFoundPersons($_POST, $foundPersons);
    }

    public function showFoundPersons(array $post, PersonCollection $foundPersons): void
    {

        $personList = [];
        foreach ($foundPersons->getPersonData() as $person) {
            $personList[] =
                [
                    'name' => $person->getName(),
                    'surname' => $person->getSurname(),
                    'personalId' => $person->getPersonalId(),
                    'age' => $person->getAge(),
                    'address' => $person->getAddress(),
                    'personality' => $person->getPersonality()
                ];
        }

        $loader = new FilesystemLoader('Views');
        $twig = new Environment($loader);

        echo $twig->render('search.html', [
            'post' => $post[key($post)],
            'list' => $personList,
            'button' => 'personalId'
        ]);

    }

}


