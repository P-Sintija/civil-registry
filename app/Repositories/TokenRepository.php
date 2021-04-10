<?php
namespace App\Repositories;

use App\Models\Token;
use App\Models\TokenCollection;

interface TokenRepository
{
    public function createToken(string $id, string $token): void;

    public function getTokens(): TokenCollection;

    public function tokenExists(string $token): bool;

    public function searchPersonalId(string $token): Token;

    public function delete(string $value): void;

}