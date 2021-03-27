<?php
namespace App\Controllers;

class PersonController
{
    public function showPage()
    {
        echo 'found page';
        require_once 'app/Views/found.php';
    }

    public function edit() {
        echo 'editing';
        require_once 'app/Views/submit.php';
    }

}
