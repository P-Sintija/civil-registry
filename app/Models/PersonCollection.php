<?php
namespace App\Models;

class PersonCollection
{
    private array $personData =[];

    public function addPerson(Person $person): void
    {
        $this->personData[] = $person;
    }

    public function getPersonData(): array
    {
        return $this->personData;
    }

}

