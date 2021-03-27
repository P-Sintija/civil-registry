<?php
namespace App\Controllers;

use App\Models\Register;

class EditController
{
    public function showPage()
    {
        echo 'show edit';
        require_once 'app/Views/edit.php';
    }


    public function edit()
    {

        var_dump($_SERVER['REQUEST_METHOD']);
        var_dump($_GET);
        var_dump($_POST);

        echo "EDIT";

        require_once 'app/Views/edit.php';
    }

}

