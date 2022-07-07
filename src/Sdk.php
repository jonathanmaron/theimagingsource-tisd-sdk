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
 * @copyright © 2022 The Imaging Source Europe GmbH
 */

namespace Tisd\Sdk;

use Tisd\Sdk\Cache\Cache;
use Tisd\Sdk\Defaults\Defaults;

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
     * @var Cache
     */
    protected Cache $cache;

    /**
     * Context
     *
     * @var string
     */
    protected string $context;

    /**
     * Hostname
     *
     * @var string
     */
    protected string $hostname;

    /**
     * Locale
     *
     * @var string
     */
    protected string $locale;

    /**
     * Timeout
     *
     * @var int
     */
    protected int $timeout;

    /**
     * Version
     *
     * @var string
     */
    protected string $version;

    /**
     * Sdk constructor
     *
     * @param array $options
     */
    public function __construct(array $options = [])
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
                // @phpstan-ignore-next-line
                $value = $defaults->$getter();
            }

            $setter = sprintf('set%s', ucfirst($optionKey));
            // @phpstan-ignore-next-line
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
     * @return Cache
     */
    public function getCache(): Cache
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
    public function setCache(Cache $cache): self
    {
        $this->cache = $cache;

        return $this;
    }

    /**
     * Get the context
     *
     * @return string
     */
    public function getContext(): string
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
    public function setContext(string $context): self
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get the hostname
     *
     * @return string
     */
    public function getHostname(): string
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
    public function setHostname(string $hostname): self
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * Get the locale
     *
     * @return string
     */
    public function getLocale(): string
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
    public function setLocale(string $locale): self
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
    public function getTimeout(): int
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
    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get the version
     *
     * @return string
     */
    public function getVersion(): string
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
    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }
}
