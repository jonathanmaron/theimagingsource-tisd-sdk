<?php

namespace TisdTest\Sdk\Validator;

use PHPUnit_Framework_TestCase;

use Tisd\Sdk\Validator\PackageId as Validator;

class PackageIdTest extends PHPUnit_Framework_TestCase
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

        $this->assertTrue ($this->validator->isValid('flhc12142m'));
    }
}
