<?php
namespace App\Controllers;

use App\Models\Register;

class FoundController
{
    public function showPage()
    {
        echo 'show found';
        require_once 'app/Views/found.php';
    }


    public function delete()
    {
        echo "DELETE";

       // var_dump($_POST);

        require_once 'app/Views/home.php';
    }

}
