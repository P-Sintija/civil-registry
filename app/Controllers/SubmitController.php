<?php


namespace App\Controllers;


use App\Models\PersonAdmin;

class SubmitController
{
    public function showPage(): void
    {
        echo 'GET SUBMITCONTROLLER -> SHOWPAGE' . '<br>';

        require_once 'app/Views/submit.php';
    }

    public function savePerson(): void
    {
        echo 'Save Person';

        $personData = new PersonAdmin();

        if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['personalCode'])) {
            $personData->validateInput($_POST['name'], $_POST['username'], $_POST['personalCode']);
        }

        require_once 'app/Views/submit.php';
    }

    public function deletePerson(): void
    {
        $personData = new PersonAdmin();
        $personData->delete(key($_POST), $_POST[key($_POST)]);

        (new HomeController())->showHomePage();
    }


}
