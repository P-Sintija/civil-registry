<?php

namespace App\Models;


class PersonAdmin
{
    private Saver $database;
    private PersonCollection $persons;

    public function __construct()
    {
        $this->database = new SQLRepository();
        $this->persons = $this->database->getPersonData();
    }

    public function getPersons(): PersonCollection
    {
        return $this->persons;
    }


    public function validateInput(string $name, string $surname, string $code): void
    {
        echo 'PERSON ADMIN->VALIDATE INPUT -> SQL->SAVE';
        echo 'name:' . $name . '  surname:' . $surname . '  code:' . $code;

        //todo - validācija visiem inputiem, vai vārdā nav char,
        // vai personas kodā nav char un vai tāds jau neeksistē;


        $this->database->savePersonData($name, $surname, $code);
    }

    public function search(string $key, string $value): PersonCollection
    {
        $search = new PersonCollection();
        if (strlen($value) > 0) {
            $search = $this->database->search($key, $value);
        }
        return $search;
    }

    public function delete(string $key, string $value): void
    {
        $this->database->delete($key, $value);
    }

}

