<?php

namespace App\ Controllers;

use App\Services\PersonListService;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class PersonListController
{
    private PersonListService $service;

    public function __construct(PersonListService $service)
    {
        $this->service = $service;
    }

    public function showPage(): void
    {
        $persons = $this->service->getPersonsList();

        $personList = [];
        foreach ($persons->getPersonData() as $person) {
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

        echo $twig->render('person-list.html', [
            'list' => $personList
        ]);

    }

}
