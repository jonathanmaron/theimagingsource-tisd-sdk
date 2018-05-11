<?php

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
     * Time-to-live
     *
     * @var integer
     */
    protected $ttl;

    /**
     * AbstractCache constructor
     *
     * @param array $options
     */
    public function __construct($options = [])
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
    public function getPath()
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
    public function setPath($path)
    {
        $this->path = $path;

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
     * Get the cache ID
     *
     * @param string $uri
     *
     * @return string
     */
    public function getId($uri)
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
    public function getFilename($cacheId, $user = null)
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
    public function getUser()
    {
        $userApache = trim(getenv('APACHE_RUN_USER'));
        $userCli    = trim(getenv('LOGNAME'));

        $ret = 'nouser';

        if (strlen($userApache) > 0) {
            $ret = $userApache;
        } elseif (strlen($userCli) > 0) {
            $ret = $userCli;
        }

        return $ret;
    }
}
