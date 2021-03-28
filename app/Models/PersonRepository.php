<?php

namespace App\Models;


interface PersonRepository
{
    public function save(array $newInfo): void;

    public function search(string $key, string $value): PersonCollection;

    public function checkPersonExists(array $info): bool;

    public function edit(Person $person, array $editedInfo): void;

    public function delete(string $key, string $value): void;
}

