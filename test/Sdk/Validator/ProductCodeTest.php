<?php

namespace TisdTest\Sdk\Validator;

use PHPUnit_Framework_TestCase;

use Tisd\Sdk\Validator\ProductCode as TisdSdkValidatorPackageCode;

class ProductCodeTest extends PHPUnit_Framework_TestCase
{
    protected $validator;

    protected function setUp()
    {
        $this->validator = new TisdSdkValidatorPackageCode();
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
