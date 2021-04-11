<?php
namespace App\Controllers;


use App\Services\UserAdminService;

class HomeController
{
    private UserAdminService $service;

    public function __construct(UserAdminService $service)
    {
        $this->service = $service;
    }

    public function showHomePage(): void
    {
        $tokens = $this->service->getTokens();
        if(count($tokens->getTokens()) > 0) {
            foreach ($tokens->getTokens() as $token) {
                if ($token->getTime() <= time()) {
                    if(isset($_SESSION['user'][$token->getId()])){
                        unset($_SESSION['user'][$token->getId()]);
                    }
                    $this->service->AutoLogOut($token->getId());
                }
            }
        }

        require_once __DIR__ . '/../../public/Views/home.html';
    }

}




