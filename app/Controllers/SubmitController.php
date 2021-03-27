<?php


namespace App\Controllers;

use App\Models\Register;

class SubmitController
{
    public function showPage()
    {
        var_dump($_SERVER['REQUEST_METHOD']);
        var_dump($_GET);
        var_dump($_POST);



        echo 'show submit';
        require_once 'app/Views/submit.php';
    }

    public function submit()
    {
        var_dump($_SERVER['REQUEST_METHOD']);
        var_dump($_GET);
        var_dump($_POST);

        $register = new Register();
        if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['personalCode'])){
            $register->savePersonData($_POST['name'],$_POST['username'],$_POST['personalCode']);
        }

        echo 'post submit';
        require_once 'app/Views/submit.php';
    }
}
