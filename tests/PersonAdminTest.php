<?php
namespace Tests;

use App\Models\PersonAdmin;
use App\Models\PersonCollection;
use PHPUnit\Framework\TestCase;

class PersonAdminTest extends TestCase
{

    public function testValidateInput(): void
    {
        $persons = new PersonAdmin();

        $trueData = [
            'name' => 'Anna',
            'surname' => 'Beka',
            'personalId' => '12345678901'
        ];

        $falseData = [
            'name' => '',
            'surname' => 'Beka',
            'personalId' => '12345%78901'
        ];

        $this->assertIsBool($persons->validateInput($trueData));
        $this->assertTrue($persons->validateInput($trueData));
        $this->assertFalse($persons->validateInput($falseData));
    }

    public function testSearch(): void
    {
        $persons = new PersonAdmin();
        $this->assertInstanceOf(PersonCollection::class, $persons->search('name','Anna'));
    }

}

