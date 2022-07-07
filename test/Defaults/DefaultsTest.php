<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Defaults;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Defaults\Defaults;

class DefaultsTest extends TestCase
{
    protected Defaults $defaults;

    protected function setUp(): void
    {
        $this->defaults = new Defaults();
    }

    protected function tearDown(): void
    {
        unset($this->sdk);
    }

    public function testGetContext(): void
    {
        self::assertEmpty($this->defaults->getContext());
    }

    public function testGetHostname(): void
    {
        self::assertEquals(Defaults::HOSTNAME_PRODUCTION, $this->defaults->getHostname());
    }

    public function testGetLocale(): void
    {
        self::assertEquals(Defaults::LOCALE, $this->defaults->getLocale());
    }

    public function testGetTimeout(): void
    {
        self::assertEquals(Defaults::TIMEOUT, $this->defaults->getTimeout());
    }

    public function testGetVersion(): void
    {
        self::assertEquals(Defaults::VERSION, $this->defaults->getVersion());
    }

    public function testSetAndGetContext(): void
    {
        $this->defaults->setContext(Defaults::CONTEXT_MACHINE_VISION);

        self::assertEquals(Defaults::CONTEXT_MACHINE_VISION, $this->defaults->getContext());
    }

    public function testSetAndGetHostname(): void
    {
        $this->defaults->setHostname(Defaults::HOSTNAME_PRODUCTION);

        self::assertEquals(Defaults::HOSTNAME_PRODUCTION, $this->defaults->getHostname());
    }

    public function testSetAndGetLocale(): void
    {
        $this->defaults->setLocale(Defaults::LOCALE);

        self::assertEquals(Defaults::LOCALE, $this->defaults->getLocale());
    }

    public function testSetAndGetTimeout(): void
    {
        $this->defaults->setTimeout(Defaults::TIMEOUT);

        self::assertEquals(Defaults::TIMEOUT, $this->defaults->getTimeout());
    }

    public function testSetAndGetVersion(): void
    {
        $this->defaults->setVersion(Defaults::VERSION);

        self::assertEquals(Defaults::VERSION, $this->defaults->getVersion());
    }
}
