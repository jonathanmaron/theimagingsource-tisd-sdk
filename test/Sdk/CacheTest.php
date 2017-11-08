<?php

namespace TisdTest\Sdk;

use PHPUnit_Framework_TestCase;
use Tisd\Sdk;
use Tisd\Sdk\Cache;

class CacheTest extends PHPUnit_Framework_TestCase
{
    protected $cache;

    protected function setUp()
    {
        $this->cache = new Cache;
    }

    protected function tearDown()
    {
        unset($this->cache);
    }

    public function testGetFilename()
    {
        $actual = $this->cache->getFilename('aaa');

        $expected = sprintf('%s/tisd_sdk_cache_aaa_%s.php', sys_get_temp_dir(), $this->cache->getUser());

        $this->assertEquals($actual, $expected);
    }

    public function testGetId()
    {
        $actual = $this->cache->getId('https://www.example.com');

        $expected = 'cdb4d88dca0bef8defe13d71624a46e7e851750a750a5467d53cb1bf273ab973';

        $this->assertEquals($actual, $expected);
    }

    public function testGetUserApache()
    {
        putenv("APACHE_RUN_USER=apache-user");

        $expected = trim(getenv('APACHE_RUN_USER'));

        $this->assertEquals($expected, $this->cache->getUser());
    }

    public function testPurge()
    {
        $sdk = new Sdk();       // ensure there is something in the cache
                                // so that it can be purged, and return true
        $sdk->getPackages();

        $this->assertTrue($sdk->getCache()->purge());
    }

    public function testRead()
    {
        $cacheId  = $this->generateRandomCacheId();
        $expected = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $this->cache->write($cacheId, $expected);

        $actual = $this->cache->read($cacheId);

        $this->assertEquals($expected, $actual);
    }

    public function testReadCacheFileNotReadable()
    {
        $cacheId  = $this->generateRandomCacheId();
        $expected = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $filename = $this->cache->getFilename($cacheId);

        $this->cache->write($cacheId, $expected);

        unlink($filename);

        $actual = $this->cache->read($cacheId);

        $this->assertFalse($actual);
    }

    public function testReadCacheExpired()
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

        $this->assertFalse($actual);
    }

    public function testSetAndGetPath()
    {
        $expected = sys_get_temp_dir() . '/test';

        $this->cache->setPath($expected);

        $actual = $this->cache->getPath();

        $this->assertEquals($expected, $actual);
    }

    public function testSetAndGetTtl()
    {
        $expected = 100;

        $this->cache->setTtl($expected);

        $actual = $this->cache->getTtl();

        $this->assertEquals($expected, $actual);
    }

    public function testWrite()
    {
        $cacheId = $this->generateRandomCacheId();
        $data = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $ret = $this->cache->write($cacheId, $data);

        $this->assertTrue(is_integer($ret));
    }

    public function testWriteUnlinkFile()
    {
        $cacheId = $this->generateRandomCacheId();
        $data = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $ret1 = $this->cache->write($cacheId, $data);
        $ret2 = $this->cache->write($cacheId, $data);

        $this->assertTrue(is_integer($ret1));
        $this->assertTrue(is_integer($ret2));
    }

    protected function generateRandomCacheId()
    {
        $cacheId = hash('sha256', rand(0, 9999999999));

        return $cacheId;
    }

}
