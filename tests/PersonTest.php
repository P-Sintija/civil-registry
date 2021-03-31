<?php
namespace Tests;

use App\Models\Person;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    public function testName(): void
    {
        $person = new Person('Anna','Beka','12345678901', 23, 'adrese');
        $this->assertIsString($person->getName());
        $this->assertGreaterThanOrEqual(1,strlen($person->getName()));
        $this->assertLessThanOrEqual(255,strlen($person->getName()));
    }

    public function testSurname(): void
    {
        $person = new Person('Anna','Beka','12345678901', 23, 'adrese');
        $this->assertIsString($person->getSurname());
        $this->assertGreaterThanOrEqual(1,strlen($person->getSurname()));
        $this->assertLessThanOrEqual(255,strlen($person->getSurname()));
    }

    public function testPersonalId(): void
    {
        $person = new Person('Anna','Beka','12345678901', 23, 'adrese');
        $this->assertIsString($person->getPersonalId());
        $this->assertEquals(11,strlen($person->getPersonalId()));
    }

    public function testAge(): void
    {
        $person = new Person('Anna','Beka','12345678901', 23, 'adrese');
        $this->assertIsInt($person->getAge());
        $this->assertGreaterThanOrEqual(0, $person->getAge());
        $this->assertLessThan(110,$person->getAge());
    }
}


