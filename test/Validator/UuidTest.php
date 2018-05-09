<?php

namespace TisdTest\Sdk\Validator;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Validator\Uuid as Validator;

class UuidTest extends TestCase
{
    protected $validator;

    protected function setUp()
    {
        $this->validator = new Validator();
    }

    protected function tearDown()
    {
        unset($this->validator);
    }

    public function testIsValid()
    {
        $this->assertFalse($this->validator->isValid('1111111111'));

        $this->assertTrue($this->validator->isValid('f6ea27be-096a-509d-84bc-b267f100f0a4'));
    }
}
