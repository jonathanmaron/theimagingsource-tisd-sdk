<?php

namespace TisdTest\Sdk\Validator;

use PHPUnit_Framework_TestCase;

use Tisd\Sdk\Validator\ProductCodeId as TisdSdkValidatorProductCodeId;

class ProductCodeIdTest extends PHPUnit_Framework_TestCase
{
    protected $validator;

    protected function setUp()
    {
        $this->validator = new TisdSdkValidatorProductCodeId();
    }

    protected function tearDown()
    {
        unset($this->validator);
    }

    public function testComingSoon()
    {
        $this->markTestSkipped();
    }
}
