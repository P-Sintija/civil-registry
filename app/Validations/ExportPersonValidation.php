<?php

namespace App\Validations;

use App\Services\StoreRequest;

class ExportPersonValidation
{
    public function validatePost(StoreRequest $post): bool
    {
        if ($this->validateText($post->getName()) &&
            $this->validateText($post->getSurname()) &&
            $this->validateCode($post->getPersonalId()) &&
            $this->validateAge($post->getAge())
        ) {
            return true;
        }
        return false;
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

    private function validateAge(string $age): bool
    {
        if (is_numeric($age) && (int)$age >= 0 && (int)$age < 110) {
            return true;
        }
        return false;
    }


}