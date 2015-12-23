<?php

namespace TisdTest\Sdk\Lut;

use PHPUnit_Framework_TestCase;

use Tisd\Sdk\Lut\PackageIdToPackage as Lut;

class PackageIdToPackageTest extends PHPUnit_Framework_TestCase
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
        $result = $this->lut->getValues();

        $this->assertTrue(is_array($result));

        $this->assertArrayHasKey('icwdmdcamtis', $result);
    }

    public function testGetKeys()
    {
        $result = $this->lut->getKeys();

        $this->assertTrue(is_array($result));

        $this->assertContains('icwdm1394btis', $result);
        $this->assertContains('icwdm878tis'  , $result);

    }

    public function testGetValue()
    {
        $result = $this->lut->getValue('icwdm1394btis');

        $this->assertTrue(is_array($result));

        $this->assertArrayHasKey('unique_id', $result);
        $this->assertArrayHasKey('versions' , $result);
    }

}
