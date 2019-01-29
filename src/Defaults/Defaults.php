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
 * Class Defaults
 *
 * @package Tisd\Sdk\Defaults
 */
class Defaults extends AbstractDefaults
{
    /**
     * Defaults constructor
     */
    public function __construct()
    {
        $this->setContext(null);
        $this->setHostname(self::HOSTNAME_PRODUCTION);
        $this->setLocale(self::LOCALE);
        $this->setTimeout(self::TIMEOUT);
        $this->setTtl(self::TTL);
        $this->setVersion(self::VERSION);
    }

    /**
     * Get the context
     *
     * @return string
     */
    public function getContext(): ?string
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
    public function setContext(?string $context): self
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get the hostname
     *
     * @return string
     */
    public function getHostname(): ?string
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
    public function getLocale(): ?string
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

        return $this;
    }

    /**
     * Get the timeout
     *
     * @return int
     */
    public function getTimeout(): ?int
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
     * Get the time-to-live
     *
     * @return int
     */
    public function getTtl(): int
    {
        return $this->ttl;
    }

    /**
     * Set the time-to-live
     *
     * @param int $ttl
     *
     * @return $this
     */
    public function setTtl(int $ttl): self
    {
        $this->ttl = $ttl;

        return $this;
    }

    /**
     * Get the version
     *
     * @return string
     */
    public function getVersion(): ?string
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
