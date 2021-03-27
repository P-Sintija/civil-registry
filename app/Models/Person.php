<?php

namespace App\Models;

class Person {
    private string $name;
    private string $surname;
    private string $personalCode;

    public function __construct(string $name, string $surname, string $code)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->personalCode = $code;
    }


    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function setPersonalCode(string $code): void
    {
        $this->personalCode = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getPersonalCode(): string
    {
        return $this->personalCode;
    }
}

