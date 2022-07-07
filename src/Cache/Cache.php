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

namespace Tisd\Sdk\Cache;

/**
 * Class Cache
 *
 * @package Tisd\Sdk\Cache
 */
class Cache extends AbstractCache
{
    /**
     * Write data to the cache file
     *
     * @param string $cacheId
     * @param array  $data
     *
     * @return bool
     */
    public function write(string $cacheId, array $data): bool
    {
        $filename = $this->getFilename($cacheId);

        if (is_file($filename)) {
            unlink($filename);
        }

        $buffer = sprintf("<?php\n\nreturn %s;\n", var_export($data, true));

        return is_int(file_put_contents($filename, $buffer));
    }

    /**
     * Read data from the cache file
     *
     * @param string $cacheId
     *
     * @return array
     */
    public function read(string $cacheId): array
    {
        $ret = [];

        $filename = $this->getFilename($cacheId);

        if (is_readable($filename)) {
            $timestamp = filemtime($filename);
            assert(is_int($timestamp));
            if ($timestamp + $this->getTtl() > time()) {
                $ret = (array) include $filename;
            }
        }

        return $ret;
    }

    /**
     * Purge the cache file
     *
     * @param string $user
     *
     * @return bool
     */
    public function purge(string $user = ''): bool
    {
        $ret = false;

        if ('' === $user) {
            $user = $this->getUser();
        }

        $filenames = glob($this->getFilename('*', $user));
        assert(is_array($filenames));
        foreach ($filenames as $filename) {
            $ret = unlink($filename);
        }

        return $ret;
    }
}
