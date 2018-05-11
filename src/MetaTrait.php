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

use Tisd\Sdk\Exception\InvalidArgumentException;

/**
 * Trait MetaTrait
 *
 * @package Tisd\Sdk
 */
trait MetaTrait
{
    /**
     * Get the array of consolidated data
     *
     * @return array
     */
    abstract protected function getConsolidated();

    /**
     * Get the array of meta-data
     *
     * @return array
     */
    public function getMeta()
    {
        $consolidated = $this->getConsolidated();

        return $consolidated['meta'] ?? [];
    }

    /**
     * Get the category count
     *
     * @return int
     */
    public function getCategoryCount()
    {
        $meta = $this->getMeta();

        return (int) $meta['category']['count'] ?? 0;
    }

    /**
     * Get the section count
     *
     * @return int
     */
    public function getSectionCount()
    {
        $meta = $this->getMeta();

        return (int) $meta['section']['count'] ?? 0;
    }

    /**
     * Get the package count
     *
     * @return int
     */
    public function getPackageCount()
    {
        $meta = $this->getMeta();

        return (int) $meta['package']['count'] ?? 0;
    }

    /**
     * Get the build time
     *
     * @param string $type
     *
     * @return mixed
     */
    public function getBuildTime($type = 'timestamp')
    {
        $types = [
            'timestamp',
            'rtf_2822',
            'iso_8601',
        ];

        if (!in_array($type, $types)) {
            $format  = '"type" must be one of %s';
            $message = sprintf($format, implode(', ', $types));
            throw new InvalidArgumentException($message);
        }

        $meta = $this->getMeta();

        return $meta['build']['time'][$type] ?? null;
    }
}
