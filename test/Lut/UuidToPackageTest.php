<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Lut;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Lut\UuidToPackage as Lut;

class UuidToPackageTest extends TestCase
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

        $this->assertArrayHasKey('059f8cbe-9a03-5ad8-809e-90b33380a673', $actual);
    }

    public function testGetKeys(): void
    {
        $actual = $this->lut->getKeys();

        $this->assertTrue(is_array($actual));

        $this->assertContains('efa0ed86-f2ca-5fc1-b895-3cdae849e7a5', $actual);
        $this->assertContains('696ee548-522a-5619-95d9-37e617bbc7a0', $actual);
    }

    public function testGetValue(): void
    {
        $actual = $this->lut->getValue('f6ea27be-096a-509d-84bc-b267f100f0a4');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('uuid', $actual);
        $this->assertArrayHasKey('versions', $actual);
    }
}
