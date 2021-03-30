<?php

namespace App\Models;

use App\Validations\ImportPersonValidation;

class PersonCollection
{
    private array $personData = [];

    public function addValidatedPerson(Person $person): void
    {
        $validation = new ImportPersonValidation();
        if ($validation->validateImport(
            $person->getName(),
            $person->getSurname(),
            $person->getPersonalId()
        )) {
            $this->personData[] = $person;
        }
    }

    public function getPersonData(): array
    {
        return $this->personData;
    }

}

