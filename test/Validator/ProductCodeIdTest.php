<?php

namespace TisdTest\Sdk\Validator;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Validator\ProductCodeId as Validator;

class ProductCodeIdTest extends TestCase
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
        $this->assertFalse($this->validator->isValid('invalid'));

        $this->assertTrue($this->validator->isValid('flhc12142m'));
    }
}
