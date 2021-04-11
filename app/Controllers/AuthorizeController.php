<?php

namespace App\Controllers;

use App\Services\AuthorizeUserService;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AuthorizeController
{
    private AuthorizeUserService $service;

    public function __construct(AuthorizeUserService $service)
    {
        $this->service = $service;
    }

    public function showPage(): void
    {
        $loader = new FilesystemLoader('Views');
        $twig = new Environment($loader);
        echo $twig->render('authorize.html', [
            'post' => $_POST,
        ]);
    }

    public function createUser(): void
    {
        $loader = new FilesystemLoader('Views');
        $twig = new Environment($loader);

        $user = $this->service->searchPerson(key($_POST), $_POST[key($_POST)])->getPersonData();

        if (count($user) == 1) {
            $_SESSION['user'][$user[0]->getId()] = $user[0]->getPersonalId();
            echo $twig->render('authorize.html', [
                'post' => $_POST,
                'link' => $_SERVER['HTTP_ORIGIN'] .
                    '/auth?token=' .
                    $this->service->createToken($user[0]),
                'message' => 'authorization was successful'
            ]);
        } else {
            require_once __DIR__ . '/../../public/Views/error.html';
        }
    }

}