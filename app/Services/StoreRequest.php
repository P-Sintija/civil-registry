<?php

namespace App\Services;

class StoreRequest
{
    private string $name;
    private string $surname;
    private string $personalId;
    private ?string $personality;

    public function __construct(string $name, string $surname, string $code, string $personality = null)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->personalId = $code;
        $this->personality = $personality;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getPersonalId(): string
    {
        return $this->personalId;
    }

    public function getPersonality(): ?string
    {
        return $this->personality;
    }

}

