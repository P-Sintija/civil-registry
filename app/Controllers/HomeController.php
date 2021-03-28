<?php

namespace App\Controllers;


class HomeController
{

    public function showHomePage(): void
    {
        require_once 'app/Views/home.php';
    }

}




