<?php

namespace TisdTest\Sdk;

use PHPUnit_Framework_TestCase;
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
        $this->markTestSkipped();
    }

    public function testGetId()
    {
        $this->markTestSkipped();
    }

    public function testGetUserCli()
    {
        $expected = trim(getenv('LOGNAME'));

        $this->assertEquals($expected, $this->cache->getUser());
    }

    public function testGetUserApache()
    {
        putenv("APACHE_RUN_USER=apache-user");

        $expected = trim(getenv('APACHE_RUN_USER'));

        $this->assertEquals($expected, $this->cache->getUser());
    }

    public function testPurge()
    {
        $this->markTestSkipped();
    }

    public function testRead()
    {
        $this->markTestSkipped();
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
        $this->markTestSkipped();
    }

    public function testWriteUnlinkFile()
    {
        $cacheId = 'cache-id';
        $data    = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $ret1 = $this->cache->write($cacheId, $data);
        $ret2 = $this->cache->write($cacheId, $data);

        $this->assertTrue(is_integer($ret1));
        $this->assertTrue(is_integer($ret2));
    }

}
