<?php

namespace App\Controllers;

use App\Models\PersonAdmin;
use App\Models\PersonCollection;


class SearchController
{
    public function showPage(): void
    {
        echo 'GET SEARCHCONTROLLER -> SHOWPAGE' . '<br>';

        require_once 'app/Views/search.php';
    }

    public function searchPerson(): void
    {
        $personData = new PersonAdmin();

        var_dump($_POST);
        $search = new PersonCollection();

        if (isset($_POST[key($_POST)])) {
            $search = $personData->search(key($_POST), $_POST[key($_POST)]);
        }


        require_once 'app/Views/search.php';
    }


}
