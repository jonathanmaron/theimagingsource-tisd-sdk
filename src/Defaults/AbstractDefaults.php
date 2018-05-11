<?php

namespace Tisd\Sdk\Defaults;

/**
 * Class AbstractDefaults
 *
 * @package Tisd\Sdk\Defaults
 */
abstract class AbstractDefaults
{
    /**
     * 'Astronomy' context
     */
    public const CONTEXT_ASTRONOMY = 'astronomy';

    /**
     * 'Machine Vision' context
     */
    public const CONTEXT_MACHINE_VISION = 'machinevision';

    /**
     * 'Microscopy' context
     */
    public const CONTEXT_MICROSCOPY = 'microscopy';

    /**
     * 'Scan2Docx' context
     */
    public const CONTEXT_SCAN2DOCX = 'scan2docx';

    /**
     * 'Scan2Voice' context
     */
    public const CONTEXT_SCAN2VOICE = 'scan2voice';

    /**
     * Backend hostname (development)
     */
    public const HOSTNAME_DEVELOPMENT = 'dl.theimagingsource.com.development';

    /**
     * Backend hostname (production)
     */
    public const HOSTNAME_PRODUCTION = 'dl.theimagingsource.com';

    /**
     * Default locale
     */
    public const LOCALE = 'en_US';

    /**
     * Default timeout in seconds
     */
    public const TIMEOUT = 25;

    /**
     * Default time-to-live in seconds (4 weeks)
     */
    public const TTL = 2419200;

    /**
     * Default version
     */
    public const VERSION = '2.5';

    /**
     * Context
     *
     * @var string
     */
    protected $context;

    /**
     * Hostname
     *
     * @var string
     */
    protected $hostname;

    /**
     * Locale
     *
     * @var string
     */
    protected $locale;

    /**
     * Timeout
     *
     * @var integer
     */
    protected $timeout;

    /**
     * Time-to-live
     *
     * @var integer
     */
    protected $ttl;

    /**
     * Version
     *
     * @var string
     */
    protected $version;
}
