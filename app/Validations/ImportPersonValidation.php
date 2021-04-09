<?php

namespace App\Validations;

class ImportPersonValidation
{
    public function validateImport(string $name, string $surname, string $code, int $age): bool
    {
        return $this->validateText($name) &&
            $this->validateText($surname) &&
            $this->validateCode($code) &&
            $this->validateAge($age);
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
        $code = str_replace('-', '', $code);

        for ($i = 0; $i < strlen($code); $i++) {
            if (!is_numeric($code[$i])) {
                $char[] = $code[$i];
            }
        }

        return count($char) === 0 && strlen($code) === 11;
    }

    private function validateAge(int $age): bool
    {
        return $age >= 0 && $age < 110;
    }
}

