<?php
namespace App\Controllers;


use App\Models\PersonAdmin;


class EditController
{


    public function showPage()
    {


        echo 'GET EditCONTROLLER SHOwPAGE' . '<br>';

        var_dump($_GET);
        var_dump($_POST);


        require_once 'app/Views/edit.php';
    }


}
