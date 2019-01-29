<?php
declare(strict_types=1);

/**
 * The Imaging Source Download System PHP Wrapper
 *
 * PHP wrapper for The Imaging Source Download System Web API. Authored and supported by The Imaging Source Europe GmbH.
 *
 * @link      http://dl-gui.theimagingsource.com to learn more about The Imaging Source Download System
 * @link      https://github.com/jonathanmaron/theimagingsource-tisd-sdk for the canonical source repository
 * @license   https://github.com/jonathanmaron/theimagingsource-tisd-sdk/blob/master/LICENSE.md
 * @copyright © 2019 The Imaging Source Europe GmbH
 */

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
     * @var int
     */
    protected $timeout;

    /**
     * Time-to-live
     *
     * @var int
     */
    protected $ttl;

    /**
     * Version
     *
     * @var string
     */
    protected $version;
}
