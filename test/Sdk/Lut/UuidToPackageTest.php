<?php

namespace TisdTest\Sdk\Lut;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Lut\UuidToPackage as Lut;

class UuidToPackageTest extends TestCase
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

        $this->assertArrayHasKey('f064e359-78c2-5ba4-9f39-96aa94fe3ea8', $actual);
    }

    public function testGetKeys()
    {
        $actual = $this->lut->getKeys();

        $this->assertTrue(is_array($actual));

        $this->assertContains('58d012e3-380b-53b4-901b-bafd9fcc702a', $actual);
        $this->assertContains('0e451f84-d91b-5840-a70a-48cbceeec573', $actual);
    }

    public function testGetValue()
    {
        $actual = $this->lut->getValue('8f050bec-a920-55c1-9e08-c06c6a689b20');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('uuid', $actual);
        $this->assertArrayHasKey('versions', $actual);
    }
}
