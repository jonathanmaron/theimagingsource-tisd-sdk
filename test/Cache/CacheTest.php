<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Cache;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Cache\Cache;
use Tisd\Sdk\Sdk;

class CacheTest extends TestCase
{
    protected $cache;

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

        $this->assertEquals($actual, $expected);
    }

    public function testGetId(): void
    {
        $actual = $this->cache->getId('https://www.example.com');

        $expected = 'cdb4d88dca0bef8defe13d71624a46e7e851750a750a5467d53cb1bf273ab973';

        $this->assertEquals($actual, $expected);
    }

    public function testGetUserApache(): void
    {
        putenv("APACHE_RUN_USER=apache-user");

        $expected = trim(getenv('APACHE_RUN_USER'));

        $this->assertEquals($expected, $this->cache->getUser());
    }

    public function testPurge(): void
    {
        // ensure there is something in the cache
        // so that it can be purged, and return true
        $sdk = new Sdk();
        $sdk->getPackages();
        $this->assertTrue($sdk->getCache()->purge());
    }

    public function testRead(): void
    {
        $cacheId  = $this->generateRandomCacheId();
        $expected = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $this->cache->write($cacheId, $expected);

        $actual = $this->cache->read($cacheId);

        $this->assertEquals($expected, $actual);
    }

    protected function generateRandomCacheId(): string
    {
        $cacheId = hash('sha256', (string) random_int(PHP_INT_MIN, PHP_INT_MAX));

        return $cacheId;
    }

    public function testReadCacheFileNotReadable(): void
    {
        $cacheId  = $this->generateRandomCacheId();
        $expected = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $filename = $this->cache->getFilename($cacheId);

        $this->cache->write($cacheId, $expected);

        unlink($filename);

        $actual = $this->cache->read($cacheId);

        $this->assertNull($actual);
    }

    public function testReadCacheExpired(): void
    {
        $cacheId  = $this->generateRandomCacheId();
        $expected = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $filename = $this->cache->getFilename($cacheId);

        touch($filename);

        $filemtime = filemtime($filename);

        $this->assertLessThanOrEqual($filemtime, time());

        $this->cache->write($cacheId, $expected);

        touch($filename, $filemtime - $this->cache->getTtl() - 1);

        $actual = $this->cache->read($cacheId);

        $this->assertNull($actual);
    }

    public function testSetAndGetPath(): void
    {
        $expected = sys_get_temp_dir() . '/test';

        $this->cache->setPath($expected);

        $actual = $this->cache->getPath();

        $this->assertEquals($expected, $actual);
    }

    public function testSetAndGetTtl(): void
    {
        $expected = 100;

        $this->cache->setTtl($expected);

        $actual = $this->cache->getTtl();

        $this->assertEquals($expected, $actual);
    }

    public function testSetTtlInConstructor(): void
    {
        $expected = 10;

        $cache = new Cache(['ttl' => $expected]);

        $this->assertEquals($cache->getTtl(), $expected);
    }

    public function testWrite(): void
    {
        $cacheId = $this->generateRandomCacheId();
        $data    = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $ret = $this->cache->write($cacheId, $data);

        $this->assertTrue($ret);
    }

    public function testWriteUnlinkFile(): void
    {
        $cacheId = $this->generateRandomCacheId();
        $data    = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $ret1 = $this->cache->write($cacheId, $data);
        $ret2 = $this->cache->write($cacheId, $data);

        $this->assertTrue($ret1);
        $this->assertTrue($ret2);
    }
}
