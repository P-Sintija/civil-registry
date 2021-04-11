<?php

namespace App\Validations;

class RequestValidation
{
    public function validatePersonIdKey(string $key): bool
    {
        return $key === 'ID';
    }

    public function ifPostPresent(array $post): bool
    {
        return isset($post[key($post)]) && strlen($post[key($post)]) > 0;
    }


}