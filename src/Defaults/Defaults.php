<?php

namespace Tisd\Sdk\Defaults;

class Defaults extends AbstractDefaults
{
    public function __construct()
    {
        $this->setContext(null);
        $this->setHostname(self::HOSTNAME_PRODUCTION);
        $this->setLocale(self::LOCALE);
        $this->setTimeout(self::TIMEOUT);
        $this->setTtl(self::TTL);
        $this->setVersion(self::VERSION);
    }

    public function getContext()
    {
        return $this->context;
    }

    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    public function getHostname()
    {
        return $this->hostname;
    }

    public function setHostname($hostname)
    {
        $this->hostname = $hostname;

        return $this;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    public function getTimeout()
    {
        return $this->timeout;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function getTtl()
    {
        return $this->ttl;
    }

    public function setTtl($ttl)
    {
        $this->ttl = $ttl;

        return $this;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
