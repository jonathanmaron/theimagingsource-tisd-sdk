<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Lut;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Lut\ProductCodeToPackage as Lut;

class ProductCodeToPackageTest extends TestCase
{
    protected $lut;

    protected function setUp(): void
    {
        $this->lut = new Lut();
    }

    protected function tearDown(): void
    {
        unset($this->lut);
    }

    public function testGetValues(): void
    {
        $actual = $this->lut->getValues();

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('IC WDM GIGE TIS', $actual);
    }

    public function testGetKeys(): void
    {
        $actual = $this->lut->getKeys();

        $this->assertTrue(is_array($actual));

        $this->assertContains('IC WDM V2F TIS', $actual);
        $this->assertContains('IC Measure', $actual);
    }

    public function testGetValue(): void
    {
        $actual = $this->lut->getValue('IC Measure');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('uuid', $actual);
        $this->assertArrayHasKey('versions', $actual);
    }
}
