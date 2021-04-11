<?php

namespace App\Repositories;

use App\Models\Token;
use App\Models\TokenCollection;
use Medoo\Medoo;

class MySQLTokenRepository implements TokenRepository
{
    private Medoo $database;

    public function __construct()
    {
        $this->database = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'person-database',
            'server' => 'localhost',
            'username' => 'root',
            'password' => ''
        ]);
    }

    public function createToken(int $id, string $token): void
    {
        $this->database->insert('token', [
            'ID' => $id,
            'token' => $token,
            'time' => time() + 50
        ]);
    }

    public function getTokens(): TokenCollection
    {
        $tokens = new TokenCollection();
        $data = $this->database->select('token', '*');
        foreach ($data as $token) {
            $tokens->add(new Token($token['ID'], $token['token'], $token['time']));
        }
        return $tokens;
    }

    public function tokenExists(string $token): bool
    {
        $found = [];
        $where = ['token' => $token];
        $data = $this->database->select('token', '*', $where);
        $found[] = $data;
        return count($found['0']) > 0;
    }

    public function searchPersonalId(string $token): Token
    {
        $where = ['token' => $token];
        $data = $this->database->select('token', '*', $where);
        return new Token($data['0']['ID'], $data['0']['token'], $data['0']['time']);
    }

    public function delete(int $value): void
    {
        $where = ['ID' => $value];
        $this->database->delete('token', $where);
    }
}
