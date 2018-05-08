<?php

namespace Tisd;

class Defaults
{
    const HOSTNAME_DEVELOPMENT   = 'dl.theimagingsource.com.development';

    const HOSTNAME_PRODUCTION    = 'dl.theimagingsource.com';

    const LOCALE                 = 'en_US';

    const VERSION                = '2.5';

    const TIMEOUT                = 25;

    const CONTEXT_ASTRONOMY      = 'astronomy';

    const CONTEXT_MACHINE_VISION = 'machinevision';

    const CONTEXT_MICROSCOPY     = 'microscopy';

    const CONTEXT_SCAN2DOCX      = 'scan2docx';

    const CONTEXT_SCAN2VOICE     = 'scan2voice';

    protected static $locale;

    protected static $context;

    protected static $hostname;

    protected static $version;

    protected static $timeout;

    public static function getLocale()
    {
        if (null === self::$locale) {
            self::setLocale(self::LOCALE);
        }

        return self::$locale;
    }

    public static function setLocale($locale)
    {
        self::$locale = $locale;
    }

    public static function getContext()
    {
        return self::$context;
    }

    public static function setContext($context)
    {
        // there is no default context

        self::$context = $context;
    }

    public static function getHostname()
    {
        if (null === self::$hostname) {
            self::setHostname(self::HOSTNAME_PRODUCTION);
        }

        return self::$hostname;
    }

    public static function setHostname($hostname)
    {
        self::$hostname = $hostname;
    }

    public static function getVersion()
    {
        if (null === self::$version) {
            self::setVersion(self::VERSION);
        }

        return self::$version;
    }

    public static function setVersion($version)
    {
        self::$version = $version;
    }

    public static function getTimeout()
    {
        if (null === self::$timeout) {
            self::setTimeout(self::TIMEOUT);
        }

        return self::$timeout;
    }

    public static function setTimeout($timeout)
    {
        self::$timeout = $timeout;
    }
}
