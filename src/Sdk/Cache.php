<?php

namespace Tisd\Sdk;

class Cache
{
    const DEFAULT_TTL = 86400;

    protected $path;

    protected $ttl;

    public function __construct()
    {
        $this->setPath(sys_get_temp_dir());

        $this->setTtl(self::DEFAULT_TTL);
    }

    public function write($cacheId, $data)
    {
        $filename = $this->getFilename($cacheId);

        if (is_file($filename)) {
            unlink($filename);
        }

        $buffer = sprintf("<?php\n\nreturn %s;\n", var_export($data, true));

        $ret = file_put_contents($filename, $buffer);

        return $ret;
    }

    public function read($cacheId)
    {
        $ret = false;

        $filename = $this->getFilename($cacheId);

        if (is_readable($filename)) {
            if (filemtime($filename) + $this->getTtl() > time()) {
                $ret = include $filename;
            }
        }

        return $ret;
    }

    public function purge($user = null)
    {
        $ret = null;

        if (null === $user) {
            $user = $this->getUser();
        }

        foreach (glob($this->getFilename('*', $user)) as $filename) {
            $ret = unlink($filename);
        }

        return $ret;
    }

    public function getFilename($cacheId, $user = null)
    {
        if (null === $user) {
            $user = $this->getUser();
        }

        $prefix = str_replace('\\', '_', __CLASS__);
        $prefix = strtolower($prefix);

        $ret = sprintf('%s/%s_%s_%s.php', $this->getPath(), $prefix, $cacheId, $user);

        return $ret;
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

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($cachePath)
    {
        $this->path = $cachePath;

        return $this;
    }

    public function getTtl()
    {
        return $this->ttl;
    }

    public function setTtl($cacheTtl)
    {
        $this->ttl = $cacheTtl;

        return $this;
    }

    public function getId($url)
    {
        return hash('sha256', $url);
    }
}
