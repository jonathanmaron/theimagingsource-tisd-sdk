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
    abstract protected function getConsolidated(): ?array;

    /**
     * Get the array of meta-data
     *
     * @return array
     */
    public function getMeta(): array
    {
        $ret = [];

        $consolidated = $this->getConsolidated();

        if (isset($consolidated['meta'])) {
            $ret = $consolidated['meta'];
        }

        return $ret;
    }

    /**
     * Get the category count
     *
     * @return int
     */
    public function getCategoryCount(): int
    {
        $ret = 0;

        $meta = $this->getMeta();
        if (isset($meta['category']['count'])) {
            $ret = (int) $meta['category']['count'];
        }

        return $ret;
    }

    /**
     * Get the section count
     *
     * @return int
     */
    public function getSectionCount(): int
    {
        $ret = 0;

        $meta = $this->getMeta();
        if (isset($meta['section']['count'])) {
            $ret = $meta['section']['count'];
        }

        return $ret;
    }

    /**
     * Get the package count
     *
     * @return int
     */
    public function getPackageCount(): int
    {
        $ret = 0;

        $meta = $this->getMeta();
        if (isset($meta['package']['count'])) {
            $ret = (int) $meta['package']['count'];
        }

        return $ret;
    }

    /**
     * Get the build time
     *
     * @param string $type
     *
     * @return mixed
     */
    public function getBuildTime(string $type = 'timestamp')
    {
        $ret = null;

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

        if (isset($meta['build']['time'][$type])) {
            $ret = $meta['build']['time'][$type];
        }

        return $ret;
    }
}
