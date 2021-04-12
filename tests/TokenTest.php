<?php
namespace Tests;

use App\Models\Person;
use App\Models\Token;
use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase
{
    public function testId(): void
    {
        $person = new Person(1,'Anna','Beka','12345678901', 23, 'adrese');
        $token = new Token(
            $person->getId(),
            password_hash($person->getPersonalId(), PASSWORD_BCRYPT),
            time()
        );
        $this->assertEquals($person->getId(), $token->getId());
    }

    public function testKey(): void
    {
        $person = new Person(1,'Anna','Beka','12345678901', 23, 'adrese');
        $token = new Token(
            $person->getPersonalId(),
            password_hash($person->getPersonalId(), PASSWORD_BCRYPT),
            time()
        );
        $this->assertTrue(password_verify($person->getPersonalId(), $token->getToken()));
    }

    public function testTime(): void
    {
        $token = new Token(
            '12345678901',
            password_hash('12345678901', PASSWORD_BCRYPT),
            time()
        );
        $this->assertLessThanOrEqual($token->getTime(),time());
    }
}