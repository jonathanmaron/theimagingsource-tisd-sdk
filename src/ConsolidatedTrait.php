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
    private array $consolidated;

    /**
     * Get the Cache instance
     *
     * @return Cache
     */
    abstract public function getCache(): Cache;

    /**
     * Get the context
     *
     * @return string
     */
    abstract public function getContext(): string;

    /**
     * Get the hostname
     *
     * @return string
     */
    abstract public function getHostname(): string;

    /**
     * Get the locale
     *
     * @return string
     */
    abstract public function getLocale(): string;

    /**
     * Get the timeout
     *
     * @return int
     */
    abstract public function getTimeout(): int;

    /**
     * Get the version
     *
     * @return string
     */
    abstract public function getVersion(): string;

    /**
     * Filter the packages by key
     *
     * @param array        $packages
     * @param string       $key
     * @param array|string $value
     * @param bool         $fuzzy
     *
     * @return array
     */
    abstract protected function filter(array $packages, string $key, array|string $value, bool $fuzzy = false): array;

    /**
     * Get the array of consolidated data
     *
     * @return array
     */
    protected function getConsolidated(): array
    {
        if (0 === count($this->consolidated)) {

            $cache   = $this->getCache();
            $cacheId = $this->getLocale() . __METHOD__;

            if ($cache->getTtl() > 0) {
                $cacheId      = $cache->getId($cacheId);
                $consolidated = $cache->read($cacheId);
                if (0 === count($consolidated)) {
                    $consolidated = $this->downloadConsolidated();
                    $cache->write($cacheId, $consolidated);
                }
            } else {
                $consolidated = $this->downloadConsolidated();
            }

            if ('' !== $this->getContext()) {
                assert(is_array($consolidated['packages']));
                $packages                 = $this->filter($consolidated['packages'], 'contexts', $this->getContext());
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
     * @return Sdk
     */
    protected function setConsolidated(array $consolidated): self
    {
        $this->consolidated = $consolidated;

        return $this;
    }

    /**
     * Download the consolidated data array
     *
     * @return array
     */
    private function downloadConsolidated(): array
    {
        $format = 'https://%s/api/%s/consolidated/%s.json';
        $uri    = sprintf($format, $this->getHostname(), $this->getVersion(), $this->getLocale());

        $options = [
            'http' => [
                'timeout' => $this->getTimeout(),
                'method'  => 'GET',
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
        assert(is_string($json));

        $consolidated = json_decode($json, true);
        assert(is_array($consolidated));

        /**
         * This is a temporary measure, until the package.xml files have been updated with the
         * "platform" => "windows|linux" key.
         * In the case of a download file, added either "windows" or "linux" to the "platform" key.
         * Otherwise, an empty string.
         */
        foreach ($consolidated as &$packages) {
            foreach ($packages['children'] as &$categories) {
                foreach ($categories['children'] as &$sections) {
                    foreach ($sections['children'] as &$package) {
                        $package['platform'] = match ($package['category_id']) {
                            'downloads'       => 'windows',
                            'downloads-linux' => 'linux',
                            default           => '',
                        };
                    }
                }
            }
        }

        return $consolidated;
    }
}
