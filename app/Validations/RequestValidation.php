<?php

namespace App\Validations;

class RequestValidation
{
    public function validatePersonIdKey(string $key): bool
    {
        if ($key === 'personalId') {
            return true;
        };
        return false;
    }

    public function ifPostPresent(array $post): bool
    {
        if (isset($post[key($post)]) && strlen($post[key($post)]) > 0) {
            return true;
        }
        return false;
    }


}