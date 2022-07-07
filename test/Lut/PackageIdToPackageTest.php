<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Lut;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Lut\PackageIdToPackage as Lut;

class PackageIdToPackageTest extends TestCase
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

        self::assertArrayHasKey('icwdmdcamtis', $actual);
    }

    public function testGetKeys(): void
    {
        $actual = $this->lut->getKeys();

        self::assertContains('icwdm1394btis', $actual);
        self::assertContains('icwdm878tis', $actual);
    }

    public function testGetValue(): void
    {
        $actual = $this->lut->getValue('icwdm1394btis');

        self::assertIsArray($actual);
        self::assertArrayHasKey('uuid', $actual);
        self::assertArrayHasKey('versions', $actual);
    }
}
