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

    public function testGetUser()
    {
        $this->markTestSkipped();
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
        $this->markTestSkipped();
    }

    public function testSetAndGetTtl()
    {
        $this->markTestSkipped();
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
