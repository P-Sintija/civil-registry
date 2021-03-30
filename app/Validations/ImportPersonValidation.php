<?php

namespace App\Validations;

class ImportPersonValidation
{
    public function validateImport(string $name, string $surname, string $code): bool
    {
        if ($this->validateText($name) &&
            $this->validateText($surname) &&
            $this->validateCode($code)
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
        $code = str_replace('-', '', $code);

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

