<?php

namespace App\Controllers;

use App\Services\LoginUserService;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class LoginController
{
    private LoginUserService $service;

    public function __construct(LoginUserService $service)
    {
        $this->service = $service;
    }


    public function userInfo(): void
    {
        $loader = new FilesystemLoader('Views');
        $twig = new Environment($loader);

        $userID = 0;
        foreach ($_SESSION['user'] as $key => $value) {
            if (password_verify($value, $_GET['token'])) {
                $userID = $key;
            }
        }

        if ($this->service->successfulLogin($_GET['token'])) {
            $user = $this->service->userInfo($userID)->getPersonData()[0];
            echo $twig->render('user.html', [
                'name' => $user->getName(),
                'id' => $user->getID()
            ]);
        } else {
            header('Location:/');
        }

    }

    public function logOut(array $var): void
    {
        $this->service->LogOutUser($var);
        unset($_SESSION['user'][(int)$var['id']]);
        header('Location:/');
    }


}