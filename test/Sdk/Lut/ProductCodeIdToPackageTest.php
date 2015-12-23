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

    public function testGetValues()
    {
        $actual = $this->lut->getValues();

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('icwdmdcamtis', $actual);
    }

    public function testGetKeys()
    {
        $actual = $this->lut->getKeys();

        $this->assertTrue(is_array($actual));

        $this->assertContains('icwdm1394btis', $actual);
        $this->assertContains('icwdm878tis'  , $actual);

    }

    public function testGetValue()
    {
        $actual = $this->lut->getValue('icwdm1394btis');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('unique_id', $actual);
        $this->assertArrayHasKey('versions' , $actual);
    }

}
