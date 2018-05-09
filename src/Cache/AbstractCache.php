<?php

namespace Tisd\Sdk\Cache;

abstract class AbstractCache
{
    const DEFAULT_TTL = 2419200; // 4 weeks

    protected $path;

    protected $ttl;

    public function __construct()
    {
        $this->setPath(sys_get_temp_dir());

        $this->setTtl(self::DEFAULT_TTL);
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
