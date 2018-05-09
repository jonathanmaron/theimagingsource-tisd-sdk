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
        $this->setVersion(self::VERSION);
    }

    public function getLocale()
    {
        return self::$locale;
    }

    public function setLocale($locale)
    {
        self::$locale = $locale;
    }

    public function getContext()
    {
        return self::$context;
    }

    public function setContext($context)
    {
        self::$context = $context;
    }

    public function getHostname()
    {
        return self::$hostname;
    }

    public function setHostname($hostname)
    {
        self::$hostname = $hostname;
    }

    public function getVersion()
    {
        return self::$version;
    }

    public function setVersion($version)
    {
        self::$version = $version;
    }

    public function getTimeout()
    {
        return self::$timeout;
    }

    public function setTimeout($timeout)
    {
        self::$timeout = $timeout;
    }
}
