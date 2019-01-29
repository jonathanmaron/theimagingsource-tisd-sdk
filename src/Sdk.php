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

namespace Tisd\Sdk;

use Tisd\Sdk\Defaults\Defaults;
use Tisd\Sdk\Cache\Cache;

/**
 * Class Sdk
 *
 * @package Tisd\Sdk
 */
class Sdk
{
    use ConsolidatedTrait;
    use ContextsTrait;
    use FilterTrait;
    use LocalesTrait;
    use MetaTrait;
    use PackagesTrait;
    use PackageTrait;

    /**
     * Cache
     *
     * @var string
     */
    protected $cache;

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
     * Version
     *
     * @var string
     */
    protected $version;

    /**
     * Sdk constructor
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $defaults = new Defaults();

        $optionKeys = [
            'context',
            'hostname',
            'locale',
            'timeout',
            'version',
        ];

        foreach ($optionKeys as $optionKey) {
            if (array_key_exists($optionKey, $options)) {
                $value = $options[$optionKey];
            } else {
                $getter = sprintf('get%s', ucfirst($optionKey));
                $value  = $defaults->$getter();
            }

            $setter = sprintf('set%s', ucfirst($optionKey));
            $this->$setter($value);
        }

        $cache = new Cache();

        if (array_key_exists('ttl', $options)) {
            $ttl = $options['ttl'];
        } else {
            $ttl = Defaults::TTL;
        }

        $cache->setTtl($ttl);

        $this->setCache($cache);
    }

    /**
     * Get the Cache instance
     *
     * @return string
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * Set the Cache instance
     *
     * @param Cache $cache
     *
     * @return $this
     */
    public function setCache(Cache $cache)
    {
        $this->cache = $cache;

        return $this;
    }

    /**
     * Get the context
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set the context
     *
     * @param string $context
     *
     * @return $this
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get the hostname
     *
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * Set the hostname
     *
     * @param string $hostname
     *
     * @return $this
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * Get the locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set the locale
     *
     * @param string $locale
     *
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        $this->setConsolidated([]);

        return $this;
    }

    /**
     * Get the timeout
     *
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Set the timeout
     *
     * @param int $timeout
     *
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = (int) $timeout;

        return $this;
    }

    /**
     * Get the version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the version
     *
     * @param string $version
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
