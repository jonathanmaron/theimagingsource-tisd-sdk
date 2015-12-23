<?php

namespace TisdTest\Sdk\Validator;

use PHPUnit_Framework_TestCase;

use Tisd\Sdk\Validator\UniqueId as Validator;

class UniqueIdTest extends PHPUnit_Framework_TestCase
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

        $this->assertTrue ($this->validator->isValid('7df1a5a399'));
    }
}