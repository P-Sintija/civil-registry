<?php
namespace App\Models;

class Token
{
    private string $personalId;
    private string $token;
    private int $time;

    public function __construct(string $id, string $token, int $time)
    {
        $this->personalId = $id;
        $this->token = $token;
        $this->time = $time;
    }

    public function getPersonalId(): string
    {
        return $this->personalId;
    }


    public function getTime(): int
    {
        return $this->time;
    }
}
