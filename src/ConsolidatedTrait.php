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

namespace Tisd\Sdk;

use Tisd\Sdk\Defaults\Defaults;

/**
 * Trait ConsolidatedTrait
 *
 * @package Tisd\Sdk
 */
trait ConsolidatedTrait
{
    /**
     * Array of consolidated data
     *
     * @var array
     */
    private $consolidated;

    /**
     * Get the Cache instance
     *
     * @return string
     */
    abstract public function getCache();

    /**
     * Get the context
     *
     * @return string
     */
    abstract public function getContext();

    /**
     * Get the hostname
     *
     * @return string
     */
    abstract public function getHostname();

    /**
     * Get the locale
     *
     * @return string
     */
    abstract public function getLocale();

    /**
     * Get the timeout
     *
     * @return int
     */
    abstract public function getTimeout();

    /**
     * Get the version
     *
     * @return string
     */
    abstract public function getVersion();

    /**
     * Filter the packages by key
     *
     * @param array  $packages
     * @param string $key
     * @param string $value
     * @param bool   $fuzzy
     *
     * @return mixed
     */
    abstract protected function filter($packages, $key, $value, $fuzzy = false);

    /**
     * Get the array of consolidated data
     *
     * @return array
     */
    protected function getConsolidated()
    {
        if (null === $this->consolidated) {

            $cache   = $this->getCache();
            $cacheId = $this->getLocale() . __METHOD__;

            if ($cache->getTtl() > 0) {
                $cacheId      = $cache->getId($cacheId);
                $consolidated = $cache->read($cacheId);
                if (!$consolidated) {
                    $consolidated = $this->downloadConsolidated();
                    $cache->write($cacheId, $consolidated);
                }
            } else {
                $consolidated = $this->downloadConsolidated();
            }

            if (null !== $this->getContext()) {
                $packages = $this->filter($consolidated['packages'], 'contexts', $this->getContext());
                $consolidated['packages'] = $packages;
            }

            $this->setConsolidated($consolidated);
        }

        return $this->consolidated;
    }

    /**
     * Set the consolidated data array
     *
     * @param array $consolidated
     *
     * @return $this
     */
    protected function setConsolidated($consolidated)
    {
        $this->consolidated = $consolidated;

        return $this;
    }

    /**
     * Download the consolidated data array
     *
     * @return array
     */
    private function downloadConsolidated()
    {
        $format = 'https://%s/api/%s/consolidated/%s.json';
        $uri    = sprintf($format, $this->getHostname(), $this->getVersion(), $this->getLocale());

        $options = [
            'http' => [
                'timeout' => $this->getTimeout(),
                'method'  => "GET",
                'header'  => sprintf('User-Agent: TIS Download System SDK (PHP %s)', phpversion()),
            ],
        ];

        if ($this->getHostname() === Defaults::HOSTNAME_DEVELOPMENT) {
            $options['ssl'] = [
                'verify_peer'      => false,
                'verify_peer_name' => false,
            ];
        }

        $context = stream_context_create($options);

        $json = file_get_contents($uri, false, $context);
        $ret  = json_decode($json, true);

        return $ret;
    }
}
