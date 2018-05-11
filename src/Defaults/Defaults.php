<?php

/**
 * The Imaging Source Download System PHP Wrapper
 *
 * PHP wrapper for The Imaging Source Download System Web API. Authored and supported by The Imaging Source Europe GmbH.
 *
 * @link      http://dl-gui.theimagingsource.com to learn more about The Imaging Source Download System
 * @link      https://github.com/jonathanmaron/theimagingsource-tisd-sdk for the canonical source repository
 * @license   https://github.com/jonathanmaron/theimagingsource-tisd-sdk/blob/master/LICENSE.md
 * @copyright © 2018 The Imaging Source Europe GmbH
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
     * @param integer $timeout
     *
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = (int) $timeout;

        return $this;
    }

    /**
     * Get the time-to-live
     *
     * @return int
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * Set the time-to-live
     *
     * @param integer $ttl
     *
     * @return $this
     */
    public function setTtl($ttl)
    {
        $this->ttl = (int) $ttl;

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
