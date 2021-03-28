<?php

namespace App\Models;

use Medoo\Medoo;


class SQLRepository implements Saver
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


    private function loadData(): void
    {

        $this->persons = new PersonCollection();

        $data = $this->database->select('persons', '*');

        foreach ($data as $person) {
            $this->persons->addPerson(
                new Person($person['name'], $person['surname'], $person['personalCode']));
        }

    }

    public function getPersonData(): PersonCollection
    {
        $this->loadData();
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

    public function search(string $key, string $value): PersonCollection
    {
        $searched = new PersonCollection();

        $where = [$key => $value];

        $data = $this->database->select('persons', '*', $where);

        foreach ($data as $person) {
            $searched->addPerson(
                new Person($person['name'], $person['surname'], $person['personalCode']));
        }

        return $searched;
    }


    public function delete(string $key, string $value): void
    {
        $where = [$key => $value];

        $this->database->delete('persons', $where);
    }

}

