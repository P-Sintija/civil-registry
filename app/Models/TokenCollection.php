<?php
namespace App\Models;

class TokenCollection
{
    private array $tokens =[];

    public function add(Token $token): void
    {
        $this->tokens[] = $token;
    }

    public function getTokens(): array
    {
        return $this->tokens;
    }
}