<?php

namespace TisdTest\Sdk\Lut;

use PHPUnit_Framework_TestCase;

use Tisd\Defaults;
use Tisd\Sdk\Lut\UniqueIdToPackage as Lut;

class UniqueIdToPackageTest extends PHPUnit_Framework_TestCase
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

        $this->assertArrayHasKey('10503db497', $result);
    }

    public function testGetKeys()
    {
        $result = $this->lut->getKeys();

        $this->assertTrue(is_array($result));

        $this->assertContains('6025d93a03', $result);
        $this->assertContains('6686718ea3'  , $result);

    }

    public function testGetValue()
    {
        $result = $this->lut->getValue('10503db497');

        $this->assertTrue(is_array($result));

        $this->assertArrayHasKey('unique_id', $result);
        $this->assertArrayHasKey('versions' , $result);
    }

}
