<?php

namespace TisdTest\Sdk;

use PHPUnit\Framework\TestCase;
use Tisd\Defaults;

class DefaultsTest extends TestCase
{
    public function testGetContext()
    {
        $this->assertNull(Defaults::getContext());
    }

    public function testGetHostname()
    {
        $this->assertEquals(Defaults::HOSTNAME_PRODUCTION, Defaults::getHostname());
    }

    public function testGetLocale()
    {
        $this->assertEquals(Defaults::LOCALE, Defaults::getLocale());
    }

    public function testGetTimeout()
    {
        $this->assertEquals(Defaults::TIMEOUT, Defaults::getTimeout());
    }

    public function testGetVersion()
    {
        $this->assertEquals(Defaults::VERSION, Defaults::getVersion());
    }

    public function testSetAndGetContext()
    {
        Defaults::setContext(Defaults::CONTEXT_MACHINE_VISION);

        $this->assertEquals(Defaults::CONTEXT_MACHINE_VISION, Defaults::getContext());
    }

    public function testSetAndGetHostname()
    {
        Defaults::setHostname(Defaults::HOSTNAME_PRODUCTION);

        $this->assertEquals(Defaults::HOSTNAME_PRODUCTION, Defaults::getHostname());
    }

    public function testSetAndGetLocale()
    {
        Defaults::setLocale(Defaults::LOCALE);

        $this->assertEquals(Defaults::LOCALE, Defaults::getLocale());
    }

    public function testSetAndGetTimeout()
    {
        Defaults::setTimeout(Defaults::TIMEOUT);

        $this->assertEquals(Defaults::TIMEOUT, Defaults::getTimeout());
    }

    public function testSetAndGetVersion()
    {
        Defaults::setVersion(Defaults::VERSION);

        $this->assertEquals(Defaults::VERSION, Defaults::getVersion());
    }
}
