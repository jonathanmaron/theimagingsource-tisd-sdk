<?php

namespace Tisd;

class Defaults
{

    const HOSTNAME_DEVELOPMENT   = 'dl.theimagingsource.com.dev';
    const HOSTNAME_PRODUCTION    = 'dl.theimagingsource.com';

    const LOCALE                 = 'en_US';

    const VERSION                = '2.0';

    const TIMEOUT                = 10;

    const CONTEXT_MACHINE_VISION = 'machinevision';
    const CONTEXT_ASTRONOMY      = 'astronomy';
    const CONTEXT_SCAN2DOCX      = 'scan2docx';
    const CONTEXT_SCAN2VOICE     = 'scan2voice';


    protected static $locale = null;
    protected static $context = null;
    protected static $hostname = null;
    protected static $version = null;
    protected static $timeout = null;


    public static function setLocale($locale)
    {
        self::$locale = $locale;
    }

    public static function getLocale()
    {
        if (null === self::$locale) {
            self::setLocale(self::LOCALE);
        }

        return self::$locale;
    }


    public static function setContext($context)
    {
        // there is no default context

        self::$context = $context;
    }

    public static function getContext()
    {
        return self::$context;
    }


    public static function setHostname($hostname)
    {
        self::$hostname = $hostname;
    }

    public static function getHostname()
    {
        if (null === self::$hostname) {

            $hostname = gethostbyname(trim(`hostname`));

            if ('192.168' === substr($hostname, 0, 7)) {
                $hostname = self::HOSTNAME_DEVELOPMENT;
            } else {
                $hostname = self::HOSTNAME_PRODUCTION;
            }

            self::setHostname($hostname);
        }

        return self::$hostname;
    }


    public static function setVersion($version)
    {
        self::$version = $version;
    }

    public static function getVersion()
    {
        if (null === self::$version) {
            self::setVersion(self::VERSION);
        }

        return self::$version;
    }


    public static function setTimeout($timeout)
    {
        self::$timeout = $timeout;
    }

    public static function getTimeout()
    {
        if (null === self::$timeout) {
            self::setTimeout(self::TIMEOUT);
        }

        return self::$timeout;
    }


}