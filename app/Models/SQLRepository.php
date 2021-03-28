<?php

namespace App\Models;

use Medoo\Medoo;


class SQLRepository implements PersonRepository
{
    private Medoo $database;

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


    public function save(array $newInfo): void
    {
        $this->database->insert('persons', [
            'name' => $newInfo['name'],
            'surname' => $newInfo['surname'],
            'personalId' => $newInfo['personalId'],
            'personality' => $newInfo['personality']
        ]);
    }

    public function search(string $key, string $value): PersonCollection
    {
        $searched = new PersonCollection();

        if($key === 'personalId' && $value[6] === '-') {
            $value = substr($value,0,6) . substr($value,7,strlen($value)-1);
        }


        $data = $this->database->select('persons', '*', [$key => $value]);
        foreach ($data as $person) {
            $searched->addPerson(
                new Person($person['name'], $person['surname'], $person['personalId'], $person['personality']));
        }

        return $searched;
    }

    public function checkPersonExists(array $info): bool
    {
        $where = ['personalId' => $info['personalId']];
        if ($this->database->has('persons', $where)) {
            return true;
        }
        return false;
    }

    public function edit(Person $person, array $editedInfo): void
    {
        $where = ['personalId' => $person->getPersonalId()];

        $this->database->update('persons', [
            'name' => $editedInfo['name'],
            'surname' => $editedInfo['surname'],
            'personalId' => $editedInfo['personalId'],
            'personality' => $editedInfo['personality']
        ], $where);
    }

    public function delete(string $key, string $value): void
    {
        $where = [$key => $value];
        $this->database->delete('persons', $where);
    }

}

