<?php
namespace App\Services;

use App\Models\TokenCollection;
use App\Repositories\TokenRepository;


class UserAdminService
{
    private TokenRepository $tokenRepository;

    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    public function getTokens(): TokenCollection
    {
        return $this->tokenRepository->getTokens();
    }

    public function AutoLogOut(string $id): void
    {
        $this->tokenRepository->delete($id);
    }




}