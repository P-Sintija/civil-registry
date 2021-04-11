<?php

namespace App\Models;

class Token
{
    private string $id;
    private string $token;
    private int $time;

    public function __construct(string $id, string $token, int $time)
    {
        $this->id = $id;
        $this->token = $token;
        $this->time = $time;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTime(): int
    {
        return $this->time;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
