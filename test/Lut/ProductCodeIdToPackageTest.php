<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Lut;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Lut\ProductCodeIdToPackage as Lut;

class ProductCodeIdToPackageTest extends TestCase
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

        $this->assertArrayHasKey('icwdmdcamtis', $actual);
    }

    public function testGetKeys(): void
    {
        $actual = $this->lut->getKeys();

        $this->assertTrue(is_array($actual));

        $this->assertContains('icwdm1394btis', $actual);
        $this->assertContains('icwdm878tis', $actual);
    }

    public function testGetValue(): void
    {
        $actual = $this->lut->getValue('icwdm1394btis');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('uuid', $actual);
        $this->assertArrayHasKey('versions', $actual);
    }
}
