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
        $result = $this->lut->getValues();

        $this->assertTrue(is_array($result));

        $this->assertArrayHasKey('IC WDM GIGE TIS', $result);
    }

    public function testGetKeys()
    {
        $result = $this->lut->getKeys();

        $this->assertTrue(is_array($result));

        $this->assertContains('IC WDM V2F TIS', $result);
        $this->assertContains('IC Measure'  , $result);

    }

    public function testGetValue()
    {
        $result = $this->lut->getValue('IC Measure');

        $this->assertTrue(is_array($result));

        $this->assertArrayHasKey('unique_id', $result);
        $this->assertArrayHasKey('versions' , $result);
    }

}
