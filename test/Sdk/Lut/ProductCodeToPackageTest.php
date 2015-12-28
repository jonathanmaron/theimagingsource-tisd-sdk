<?php

namespace TisdTest\Sdk\Lut;

use PHPUnit_Framework_TestCase;
use Tisd\Sdk\Lut\ProductCodeToPackage as Lut;

class ProductCodeToPackageTest extends PHPUnit_Framework_TestCase
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

        $this->assertArrayHasKey('IC WDM GIGE TIS', $actual);
    }

    public function testGetKeys()
    {
        $actual = $this->lut->getKeys();

        $this->assertTrue(is_array($actual));

        $this->assertContains('IC WDM V2F TIS', $actual);
        $this->assertContains('IC Measure', $actual);

    }

    public function testGetValue()
    {
        $actual = $this->lut->getValue('IC Measure');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('unique_id', $actual);
        $this->assertArrayHasKey('versions', $actual);
    }

}
