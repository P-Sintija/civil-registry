<?php

namespace App\Services;

class StoreRequest
{
    private string $name;
    private string $surname;
    private string $personalId;
    private ?string $personality;

    public function __construct(string $name, string $surname, string $code, string $personality)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->personalId = $code;
        $this->setPersonality($personality);
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

    private function setPersonality(string $personality): void
    {
        if ($personality === '') {
            $personality = null;
        }
        $this->personality = $personality;
    }

}

