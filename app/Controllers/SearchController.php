<?php

namespace App\Controllers;

use App\Models\Register;

class SearchController
{
    public function showPage()
    {
        echo 'show search';
        require_once 'app/Views/search.php';
    }


    public function search() {


        var_dump($_SERVER['REQUEST_METHOD']);
        var_dump($_GET);
        var_dump($_POST);

        $message = '';

        $register = new Register();

        $found = $register->searchByName($_POST['name']);

        if(isset($_POST['name'])) {

            if (count($found->getPersonData()) > 0) {
                $message = 'I AM HERE';

                require_once 'app/Views/found.php';
            } else {
                $message = 'I AM NOT HERE';
                require_once 'app/Views/error.php';
            }
        }



    }

}
