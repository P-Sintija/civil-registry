<?php

namespace App\Models;

class Person
{
    private int $ID;
    private string $name;
    private string $surname;
    private string $personalId;
    private int $age;
    private string $address;
    private ?string $personality;

    public function __construct(
        int $ID,
        string $name,
        string $surname,
        string $code,
        int $age,
        string $address,
        string $personality = null)
    {
        $this->ID = $ID;
        $this->name = $name;
        $this->surname = $surname;
        $this->personalId = $code;
        $this->age = $age;
        $this->address = $address;
        $this->personality = $personality;
    }

    public function getID(): int
    {
        return $this->ID;
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

    public function getAge(): int
    {
        return $this->age;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

}

