<?php

namespace App\Validations;

class ExportValidation
{
    public function validatePost(array $post): bool
    {
        if (isset($post['name']) && isset($post['surname']) && isset($post['personalId']) &&
            $this->validateText($post['name']) &&
            $this->validateText($post['surname']) &&
            $this->validateCode($post['personalId'])) {
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


}