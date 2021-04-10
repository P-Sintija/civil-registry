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
                    $this->service->AutoLogOut($token->getPersonalId());
                }
            }
        }

        require_once __DIR__ . '/../../public/Views/home.html';
    }

}




