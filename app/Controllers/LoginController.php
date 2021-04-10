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

        if($this->service->successfulLogin($_GET['token'])) {
            $user = $this->service->userInfo($_GET['token'])->getPersonData()[0];
            $_SESSION['auth_id'] = $user->getPersonalId();
            echo $twig->render('user.html', [
                'name' => $user->getName(),
                'id' => $user->getPersonalId()
            ]);
        } else {
           header('Location:/');
        }
    }

    public function logOut(array $var): void
    {
        $this->service->LogOutUser($var);
        unset($_SESSION['auth_id']);
        header('Location:/');
    }

}