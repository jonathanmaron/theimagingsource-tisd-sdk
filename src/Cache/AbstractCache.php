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

namespace Tisd\Sdk\Cache;

use Tisd\Sdk\Defaults\Defaults;

/**
 * Class AbstractCache
 *
 * @package Tisd\Sdk\Cache
 */
abstract class AbstractCache
{
    /**
     * Path to cache file
     *
     * @var string
     */
    protected $path;

    /**
     * Time-to-live in seconds
     *
     * @var int
     */
    protected $ttl;

    /**
     * AbstractCache constructor
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        if (array_key_exists('ttl', $options)) {
            $ttl = $options['ttl'];
        } else {
            $ttl = Defaults::TTL;
        }

        $this->setTtl($ttl);

        // not configurable
        $this->setPath(sys_get_temp_dir());
    }

    /**
     * Get the path to cache file
     *
     * @return string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * Set the path to cache file
     *
     * @param string $path
     *
     * @return $this
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the time-to-live
     *
     * @return int
     */
    public function getTtl(): ?int
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
     * Get the cache ID
     *
     * @param string $uri
     *
     * @return string
     */
    public function getId(string $uri): string
    {
        return hash('sha256', $uri);
    }

    /**
     * Get the filename of the cache file
     *
     * @param string $cacheId
     * @param string $user
     *
     * @return string
     */
    public function getFilename(string $cacheId, ?string $user = null): string
    {
        if (null === $user) {
            $user = $this->getUser();
        }

        return sprintf('%s/tisd_sdk_cache_%s_%s.php', $this->getPath(), $cacheId, $user);
    }

    /**
     * Get the unix username of the executing user
     *
     * @return string
     */
    public function getUser(): string
    {
        $userApache = getenv('APACHE_RUN_USER');
        $userCli    = getenv('LOGNAME');

        if (is_string($userApache)) {
            return trim($userApache);
        }

        if (is_string($userCli)) {
            return trim($userCli);
        }

        return 'nouser';
    }
}
