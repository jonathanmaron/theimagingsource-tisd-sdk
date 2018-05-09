<?php

namespace TisdTest\Sdk\Defaults;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Defaults\Defaults;

class DefaultsTest extends TestCase
{
    protected $defaults;

    protected function setUp()
    {
        $this->defaults = new Defaults();
    }

    protected function tearDown()
    {
        unset($this->sdk);
    }

    public function testGetContext()
    {
        $this->assertNull($this->defaults->getContext());
    }

    public function testGetHostname()
    {
        $this->assertEquals(Defaults::HOSTNAME_PRODUCTION, $this->defaults->getHostname());
    }

    public function testGetLocale()
    {
        $this->assertEquals(Defaults::LOCALE, $this->defaults->getLocale());
    }

    public function testGetTimeout()
    {
        $this->assertEquals(Defaults::TIMEOUT, $this->defaults->getTimeout());
    }

    public function testGetVersion()
    {
        $this->assertEquals(Defaults::VERSION, $this->defaults->getVersion());
    }

    public function testSetAndGetContext()
    {
        $this->defaults->setContext(Defaults::CONTEXT_MACHINE_VISION);

        $this->assertEquals(Defaults::CONTEXT_MACHINE_VISION, $this->defaults->getContext());
    }

    public function testSetAndGetHostname()
    {
        $this->defaults->setHostname(Defaults::HOSTNAME_PRODUCTION);

        $this->assertEquals(Defaults::HOSTNAME_PRODUCTION, $this->defaults->getHostname());
    }

    public function testSetAndGetLocale()
    {
        $this->defaults->setLocale(Defaults::LOCALE);

        $this->assertEquals(Defaults::LOCALE, $this->defaults->getLocale());
    }

    public function testSetAndGetTimeout()
    {
        $this->defaults->setTimeout(Defaults::TIMEOUT);

        $this->assertEquals(Defaults::TIMEOUT, $this->defaults->getTimeout());
    }

    public function testSetAndGetVersion()
    {
        $this->defaults->setVersion(Defaults::VERSION);

        $this->assertEquals(Defaults::VERSION, $this->defaults->getVersion());
    }
}
