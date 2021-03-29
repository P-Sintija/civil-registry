<?php

namespace App\Controllers;


class HomeController
{

    public function showHomePage(): void
    {
        require_once __DIR__ . '/../../public/Views/home.php';
    }

}




