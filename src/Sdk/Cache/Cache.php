<?php

namespace Tisd\Sdk\Cache;

class Cache extends AbstractCache
{
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
}
