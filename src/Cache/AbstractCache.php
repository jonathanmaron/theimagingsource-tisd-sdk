<?php

namespace Tisd\Sdk\Cache;

use Tisd\Sdk\Defaults\Defaults;

abstract class AbstractCache
{
    protected $path;

    protected $ttl;

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

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    public function getTtl()
    {
        return $this->ttl;
    }

    public function setTtl($ttl)
    {
        $this->ttl = $ttl;

        return $this;
    }

    public function getId($uri)
    {
        return hash('sha256', $uri);
    }

    public function getFilename($cacheId, $user = null)
    {
        if (null === $user) {
            $user = $this->getUser();
        }

        return sprintf('%s/tisd_sdk_cache_%s_%s.php', $this->getPath(), $cacheId, $user);
    }

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
