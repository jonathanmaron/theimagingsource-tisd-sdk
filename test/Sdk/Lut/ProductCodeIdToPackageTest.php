<?php

namespace TisdTest\Sdk\Lut;

use PHPUnit_Framework_TestCase;

use Tisd\Sdk\Lut\ProductCodeIdToPackage as Lut;

class ProductCodeIdToPackageTest extends PHPUnit_Framework_TestCase
{
    protected $lut;

    protected function setUp()
    {
        $this->lut = new Lut();
    }

    protected function tearDown()
    {
        unset($this->lut);
    }

    public function testComingSoon()
    {
        $this->markTestSkipped();
    }
}