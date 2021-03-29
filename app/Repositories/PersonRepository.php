<?php

namespace App\Repositories;


use App\Models\Person;
use App\Models\PersonCollection;
use App\Services\StoreRequest;

interface PersonRepository
{
    public function checkPersonExists(StoreRequest $post): bool;

    public function save(StoreRequest $post): void;

    public function search(string $key, string $value): PersonCollection;

    public function edit(Person $person, StoreRequest $post): void;

    public function delete(string $key, string $value): void;
}

