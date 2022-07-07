<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Cache;

use Exception;
use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Cache\Cache;
use Tisd\Sdk\Sdk;

class CacheTest extends TestCase
{
    protected Cache $cache;

    protected function setUp(): void
    {
        $this->cache = new Cache();
    }

    protected function tearDown(): void
    {
        unset($this->cache);
    }

    public function testGetFilename(): void
    {
        $actual = $this->cache->getFilename('aaa');

        $expected = sprintf('%s/tisd_sdk_cache_aaa_%s.php', sys_get_temp_dir(), $this->cache->getUser());

        self::assertEquals($actual, $expected);
    }

    public function testGetId(): void
    {
        $actual = $this->cache->getId('https://www.example.com');

        $expected = 'cdb4d88dca0bef8defe13d71624a46e7e851750a750a5467d53cb1bf273ab973';

        self::assertEquals($actual, $expected);
    }

    public function testGetUserApache(): void
    {
        putenv("APACHE_RUN_USER=apache-user");

        $apacheRunUser = getenv('APACHE_RUN_USER');
        assert(is_string($apacheRunUser));
        $expected = trim($apacheRunUser);

        self::assertEquals($expected, $this->cache->getUser());
    }

    public function testPurge(): void
    {
        // ensure there is something in the cache
        // so that it can be purged, and return true
        $sdk = new Sdk();
        $sdk->getPackages();
        self::assertTrue($sdk->getCache()->purge());
    }

    public function testRead(): void
    {
        $cacheId  = $this->generateRandomCacheId();
        $expected = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $this->cache->write($cacheId, $expected);

        $actual = $this->cache->read($cacheId);

        self::assertEquals($expected, $actual);
    }

    protected function generateRandomCacheId(): string
    {
        try {
            $string = random_bytes(16);
        } catch (Exception $e) {
            $string = '3aa2d8e4-7020-49bc-b722-e290b1e5652a';
        }

        return hash('sha256', $string);
    }

    public function testReadCacheFileNotReadable(): void
    {
        $cacheId  = $this->generateRandomCacheId();
        $expected = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $filename = $this->cache->getFilename($cacheId);

        $this->cache->write($cacheId, $expected);

        unlink($filename);

        $actual = $this->cache->read($cacheId);

        self::assertEmpty($actual);
    }

    public function testReadCacheExpired(): void
    {
        $cacheId  = $this->generateRandomCacheId();
        $expected = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $filename = $this->cache->getFilename($cacheId);

        touch($filename);

        $filemtime = filemtime($filename);

        self::assertIsInt($filemtime);
        self::assertLessThanOrEqual($filemtime, time());

        $this->cache->write($cacheId, $expected);

        touch($filename, $filemtime - $this->cache->getTtl() - 1);

        $actual = $this->cache->read($cacheId);

        self::assertEmpty($actual);
    }

    public function testSetAndGetPath(): void
    {
        $expected = sys_get_temp_dir() . '/test';

        $this->cache->setPath($expected);

        $actual = $this->cache->getPath();

        self::assertEquals($expected, $actual);
    }

    public function testSetAndGetTtl(): void
    {
        $expected = 100;

        $this->cache->setTtl($expected);

        $actual = $this->cache->getTtl();

        self::assertEquals($expected, $actual);
    }

    public function testSetTtlInConstructor(): void
    {
        $expected = 10;

        $cache = new Cache(['ttl' => $expected]);

        self::assertEquals($cache->getTtl(), $expected);
    }

    public function testWrite(): void
    {
        $cacheId = $this->generateRandomCacheId();
        $data    = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $ret = $this->cache->write($cacheId, $data);

        self::assertTrue($ret);
    }

    public function testWriteUnlinkFile(): void
    {
        $cacheId = $this->generateRandomCacheId();
        $data    = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $ret1 = $this->cache->write($cacheId, $data);
        $ret2 = $this->cache->write($cacheId, $data);

        self::assertTrue($ret1);
        self::assertTrue($ret2);
    }
}
