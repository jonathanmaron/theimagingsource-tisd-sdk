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

        $this->assertTrue($this->validator->isValid('8f050bec-a920-55c1-9e08-c06c6a689b20'));
    }
}
