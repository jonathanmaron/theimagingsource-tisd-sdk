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
        $actual = $this->lut->getValues();

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('10503db497', $actual);
    }

    public function testGetKeys()
    {
        $actual = $this->lut->getKeys();

        $this->assertTrue(is_array($actual));

        $this->assertContains('6025d93a03', $actual);
        $this->assertContains('6686718ea3'  , $actual);

    }

    public function testGetValue()
    {
        $actual = $this->lut->getValue('10503db497');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('unique_id', $actual);
        $this->assertArrayHasKey('versions' , $actual);
    }

}
