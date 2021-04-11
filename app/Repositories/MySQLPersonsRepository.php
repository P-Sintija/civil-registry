<?php

namespace App\Repositories;

use App\Models\Person;
use App\Models\PersonCollection;
use Medoo\Medoo;
use App\Services\StoreRequest;

class MySQLPersonsRepository implements PersonRepository
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


    public function getPersonsList(): PersonCollection
    {
        $personList = new PersonCollection();

        $data = $this->database->select('persons', '*');
        foreach ($data as $person) {
            $personList->addValidatedPerson(
                new Person(
                    $person['ID'],
                    $person['name'],
                    $person['surname'],
                    $person['personalId'],
                    $person['age'],
                    $person['address'],
                    $person['personality']));
        }
        return $personList;
    }


    public function checkPersonExists(StoreRequest $post): bool
    {
        $where = ['personalId' => $post->getPersonalId()];
        if ($this->database->has('persons', $where)) {
            return true;
        }
        return false;
    }

    public function save(StoreRequest $post): void
    {
        $this->database->insert('persons', [
            'name' => $post->getName(),
            'surname' => $post->getSurname(),
            'personalId' => $post->getPersonalId(),
            'age' => $post->getAge(),
            'address' => $post->getAddress(),
            'personality' => $post->getPersonality(),
        ]);
    }

    public function search(string $key, string $value): PersonCollection
    {
        $searched = new PersonCollection();

        $data = $this->database->select('persons', '*', [$key => $value]);
        foreach ($data as $person) {
            $searched->addValidatedPerson(
                new Person(
                    $person['ID'],
                    $person['name'],
                    $person['surname'],
                    $person['personalId'],
                    $person['age'],
                    $person['address'],
                    $person['personality']));
        }
        return $searched;
    }

    public function delete(string $key, string $value): void
    {
        $where = [$key => $value];
        $this->database->delete('persons', $where);
    }

    public function edit(Person $person, StoreRequest $post): void
    {
        $where = ['personalId' => $person->getPersonalId()];

        $this->database->update('persons', [
            'name' => $post->getName(),
            'surname' => $post->getSurname(),
            'personalId' => $post->getPersonalId(),
            'age' => (string)$post->getAge(),
            'address' => $post->getAddress(),
            'personality' => $post->getPersonality()
        ], $where);
    }


}

