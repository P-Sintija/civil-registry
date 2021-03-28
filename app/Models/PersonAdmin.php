<?php

namespace App\Models;


class PersonAdmin
{
    private PersonRepository $database;

    public function __construct()
    {
        $this->database = new SQLRepository();
    }

    public function validateInput(array $data): bool
    {
        if ($this->validateText($data['name']) &&
            $this->validateText($data['surname']) &&
            $this->validateCode($data['personalId'])) {
            return true;
        }
        return false;
    }

    public function savePersonData(array $newInfo): void
    {
        if ($this->validateInput($newInfo) && !$this->database->checkPersonExists($newInfo)) {
            $this->database->save($newInfo);
        }
    }

    public function search(string $key, string $value): PersonCollection
    {
        $search = new PersonCollection();
        if (strlen($value) > 0) {
            $search = $this->database->search($key, $value);
        }
        return $search;
    }

    public function editPersonData(Person $person, array $editedInfo): void
    {
        if ($this->validateInput($editedInfo) &&
            (!$this->database->checkPersonExists($editedInfo) ||
                ($this->database->checkPersonExists($editedInfo) &&
                    $editedInfo['personalId'] === $person->getPersonalId()))) {
            $this->database->edit($person, $editedInfo);
        }
    }

    public function deletePerson(string $key, string $value): void
    {
        $this->database->delete($key, $value);
    }


    private function validateText(string $name): bool
    {
        $char = [];
        for ($i = 0; $i < strlen($name); $i++) {
            if (!in_array(strtolower($name[$i]), range('a', 'z'))) {
                $char[] = $name[$i];
            }
        }

        if (count($char) === 0 && strlen($name) > 0 && strlen($name) <= 255) {
            return true;
        }

        return false;
    }

    private function validateCode(string $code): bool
    {
        $char = [];
        for ($i = 0; $i < strlen($code); $i++) {
            if (!is_numeric($code[$i])) {
                $char[] = $code[$i];
            }
        }

        if (count($char) === 0 && strlen($code) === 11) {
            return true;
        }

        return false;
    }

}

