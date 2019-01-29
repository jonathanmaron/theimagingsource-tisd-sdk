<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Defaults;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Defaults\Defaults;

class DefaultsTest extends TestCase
{
    protected $defaults;

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
        $this->assertNull($this->defaults->getContext());
    }

    public function testGetHostname(): void
    {
        $this->assertEquals(Defaults::HOSTNAME_PRODUCTION, $this->defaults->getHostname());
    }

    public function testGetLocale(): void
    {
        $this->assertEquals(Defaults::LOCALE, $this->defaults->getLocale());
    }

    public function testGetTimeout(): void
    {
        $this->assertEquals(Defaults::TIMEOUT, $this->defaults->getTimeout());
    }

    public function testGetVersion(): void
    {
        $this->assertEquals(Defaults::VERSION, $this->defaults->getVersion());
    }

    public function testSetAndGetContext(): void
    {
        $this->defaults->setContext(Defaults::CONTEXT_MACHINE_VISION);

        $this->assertEquals(Defaults::CONTEXT_MACHINE_VISION, $this->defaults->getContext());
    }

    public function testSetAndGetHostname(): void
    {
        $this->defaults->setHostname(Defaults::HOSTNAME_PRODUCTION);

        $this->assertEquals(Defaults::HOSTNAME_PRODUCTION, $this->defaults->getHostname());
    }

    public function testSetAndGetLocale(): void
    {
        $this->defaults->setLocale(Defaults::LOCALE);

        $this->assertEquals(Defaults::LOCALE, $this->defaults->getLocale());
    }

    public function testSetAndGetTimeout(): void
    {
        $this->defaults->setTimeout(Defaults::TIMEOUT);

        $this->assertEquals(Defaults::TIMEOUT, $this->defaults->getTimeout());
    }

    public function testSetAndGetVersion(): void
    {
        $this->defaults->setVersion(Defaults::VERSION);

        $this->assertEquals(Defaults::VERSION, $this->defaults->getVersion());
    }
}
