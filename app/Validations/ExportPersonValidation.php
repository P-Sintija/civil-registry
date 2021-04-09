<?php

namespace App\Validations;

use App\Services\StoreRequest;

class ExportPersonValidation
{
    public function validatePost(StoreRequest $post): bool
    {
        return $this->validateText($post->getName()) &&
            $this->validateText($post->getSurname()) &&
            $this->validateCode($post->getPersonalId()) &&
            $this->validateAge($post->getAge());
    }


    private function validateText(string $name): bool
    {
        $char = [];
        for ($i = 0; $i < strlen($name); $i++) {
            if (!in_array(strtolower($name[$i]), range('a', 'z'))) {
                $char[] = $name[$i];
            }
        }

        return count($char) === 0 && strlen($name) > 0 && strlen($name) <= 255;
    }

    private function validateCode(string $code): bool
    {
        $char = [];
        for ($i = 0; $i < strlen($code); $i++) {
            if (!is_numeric($code[$i])) {
                $char[] = $code[$i];
            }
        }

        return count($char) === 0 && strlen($code) === 11;
    }

    private function validateAge(string $age): bool
    {
        return is_numeric($age) && (int)$age >= 0 && (int)$age < 110;
    }


}