<?php

namespace App\Controllers;

use App\Models\PersonAdmin;


class EditController
{

    public function showPage(): void
    {
        $personData = new PersonAdmin();
        $person = $personData->search(key($_GET), $_GET[key($_GET)])->getPersonData();

        require_once 'app/Views/edit.php';
    }

    public function editPerson(): void
    {
        $personData = new PersonAdmin();
        $person = $personData->search(key($_GET), $_GET[key($_GET)])->getPersonData();

        $personData->editPersonData($person[0], $_POST);

        (new HomeController())->showHomePage();
    }

}
