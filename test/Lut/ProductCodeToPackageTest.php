<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Lut;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Lut\ProductCodeToPackage as Lut;

class ProductCodeToPackageTest extends TestCase
{
    protected Lut $lut;

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

        self::assertArrayHasKey('IC WDM GIGE TIS', $actual);
    }

    public function testGetKeys(): void
    {
        $actual = $this->lut->getKeys();

        self::assertContains('IC WDM V2F TIS', $actual);
        self::assertContains('IC Measure', $actual);
    }

    public function testGetValue(): void
    {
        $actual = $this->lut->getValue('IC Measure');

        self::assertIsArray($actual);
        self::assertArrayHasKey('uuid', $actual);
        self::assertArrayHasKey('versions', $actual);
    }
}
