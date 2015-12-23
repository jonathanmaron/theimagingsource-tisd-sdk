<?php

namespace TisdTest\Sdk\Validator;

use PHPUnit_Framework_TestCase;

use Tisd\Sdk\Validator\ProductCode as Validator;

class ProductCodeTest extends PHPUnit_Framework_TestCase
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
        $this->assertFalse($this->validator->isValid('IC INVALID'));

        $this->assertTrue ($this->validator->isValid('IC WDM GIGE TIS'));
    }
}
