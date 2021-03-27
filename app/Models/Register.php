<?php

namespace App\Models;

use Medoo\Medoo;

class Register
{
    private Medoo $database;
    private PersonCollection $persons;

    public function __construct()
    {
        $this->database = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'person-database',
            'server' => 'localhost',
            'username' => 'root',
            'password' => ''
        ]);
    }


    public function loadPersonData(): void
    {

        $this->persons = new PersonCollection();

        $data = $this->database->select('persons', '*');

        foreach ($data as $person) {
            $this->persons->addPerson(
                new Person($person['name'], $person['surname'], $person['personalCode']));
        }

    }


    public function getPersons(): PersonCollection
    {
        return $this->persons;
    }



    public function savePersonData(string $name, string $surname, string $code): void
    {
        $this->database->insert('persons', [
            'name' => $name,
            'surname' => $surname,
            'personalCode' => $code
        ]);
    }

    public function searchByName(string $name): PersonCollection
    {
        $searched = new PersonCollection();

        $where = ['name' => $name];

        $data = $this->database->select('persons', '*', $where);

        foreach ($data as $person) {
            $searched->addPerson(
                new Person($person['name'], $person['surname'], $person['personalCode']));
        }

        return $searched;
    }

    public function deletePerson(string $name): void
    {
        $where = ['name' => $name];

        $this->database->delete('persons', $where);
    }

}

