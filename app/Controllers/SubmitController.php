<?php


namespace App\Controllers;


use App\Models\PersonAdmin;

class SubmitController
{
    public function showPage(): void
    {
        require_once 'app/Views/submit.php';
    }


    public function savePerson(): void
    {
        $personData = new PersonAdmin();
        if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['personalId'])) {
            $personData->savePersonData($_POST);
        }

        (new HomeController())->showHomePage();
    }


    public function deletePerson(): void
    {
        $personData = new PersonAdmin();
        $personData->deletePerson(key($_POST), $_POST[key($_POST)]);

        (new HomeController())->showHomePage();
    }


}
