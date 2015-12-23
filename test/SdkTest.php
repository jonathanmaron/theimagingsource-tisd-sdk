<?php

namespace TisdTest\Sdk;

use PHPUnit_Framework_TestCase;
use Tisd\Sdk;
use Tisd\Defaults;

class SdkTest extends PHPUnit_Framework_TestCase
{
    protected $sdk;

    protected function setUp()
    {
        $this->sdk = new Sdk;
    }

    protected function tearDown()
    {
        unset($this->sdk);
    }

    public function testBuildUrl()
    {
        $this->markTestSkipped();
    }

    public function testFilterPackages()
    {
        $this->markTestSkipped();
    }

    public function testSetAndGetBuildTime()
    {
        $actual = $this->sdk->getBuildTime();

        $this->assertTrue(is_numeric($actual));
        $this->assertTrue($actual > 1450183000);
    }

    public function testSetAndGetCache()
    {
        $this->markTestSkipped();
    }

    public function testSetAndGetCategoryCount()
    {
        $this->markTestSkipped();
    }

    public function testSetAndGetContext()
    {
        $this->sdk->setContext(Defaults::CONTEXT_MACHINE_VISION);

        $actual = $this->sdk->getContext();

        $this->assertEquals(Defaults::CONTEXT_MACHINE_VISION, $actual);
    }

    public function testSetAndGetContexts()
    {
        $this->markTestSkipped();
    }

    public function testSetAndGetHostname()
    {
        $this->sdk->setHostname(Defaults::HOSTNAME_PRODUCTION);

        $actual = $this->sdk->getHostname();

        $this->assertEquals(Defaults::HOSTNAME_PRODUCTION, $actual);
    }

    public function testSetAndGetLocale()
    {
        $this->sdk->setLocale('fr_FR');

        $actual = $this->sdk->getLocale();

        $this->assertEquals('fr_FR', $actual);
    }

    public function testSetAndGetLocales()
    {
        $actual = $this->sdk->getLocales();

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('de_DE', $actual);
        $this->assertArrayHasKey('en_US', $actual);
        $this->assertArrayHasKey('zh_CN', $actual);
        $this->assertArrayHasKey('zh_TW', $actual);

        $this->assertContains('Deutsch', $actual);
        $this->assertContains('English', $actual);
        $this->assertContains('简体中文', $actual);
        $this->assertContains('繁體中文', $actual);
    }

    public function testSetAndGetMeta()
    {
        $this->markTestSkipped();
    }

    public function testSetAndGetPackageByPackageId()
    {
        $result = $this->sdk->getPackageByPackageId('icwdmdcamtis');

        $this->assertTrue(is_array($result));

        $this->assertArrayHasKey('category_id'    , $result);
        $this->assertArrayHasKey('section_id'     , $result);
        $this->assertArrayHasKey('package_id'     , $result);
        $this->assertArrayHasKey('unique_id'      , $result);
        $this->assertArrayHasKey('locale'         , $result);
        $this->assertArrayHasKey('manufacturer'   , $result);
        $this->assertArrayHasKey('product_code'   , $result);
        $this->assertArrayHasKey('product_code_id', $result);
        $this->assertArrayHasKey('name'           , $result);
        $this->assertArrayHasKey('abstract'       , $result);
        $this->assertArrayHasKey('description'    , $result);
        $this->assertArrayHasKey('contexts'       , $result);
        $this->assertArrayHasKey('versions'       , $result);

        $version = array_shift($result['versions']);

        $this->assertArrayHasKey('number'         , $version);
        $this->assertArrayHasKey('released'       , $version);
        $this->assertArrayHasKey('file'           , $version);
        $this->assertArrayHasKey('changelog'      , $version);
        $this->assertArrayHasKey('requirements'   , $version);
        $this->assertArrayHasKey('download'       , $version);
        $this->assertArrayHasKey('pph'            , $version);
    }

    public function testSetAndGetPackageByProductCode()
    {
        $result = $this->sdk->getPackageByProductCode('IC WDM DCAM TIS');

        $this->assertTrue(is_array($result));

        $this->assertArrayHasKey('category_id'    , $result);
        $this->assertArrayHasKey('section_id'     , $result);
        $this->assertArrayHasKey('package_id'     , $result);
        $this->assertArrayHasKey('unique_id'      , $result);
        $this->assertArrayHasKey('locale'         , $result);
        $this->assertArrayHasKey('manufacturer'   , $result);
        $this->assertArrayHasKey('product_code'   , $result);
        $this->assertArrayHasKey('product_code_id', $result);
        $this->assertArrayHasKey('name'           , $result);
        $this->assertArrayHasKey('abstract'       , $result);
        $this->assertArrayHasKey('description'    , $result);
        $this->assertArrayHasKey('contexts'       , $result);
        $this->assertArrayHasKey('versions'       , $result);

        $version = array_shift($result['versions']);

        $this->assertArrayHasKey('number'         , $version);
        $this->assertArrayHasKey('released'       , $version);
        $this->assertArrayHasKey('file'           , $version);
        $this->assertArrayHasKey('changelog'      , $version);
        $this->assertArrayHasKey('requirements'   , $version);
        $this->assertArrayHasKey('download'       , $version);
        $this->assertArrayHasKey('pph'            , $version);
    }

    public function testSetAndGetPackageByProductCodeId()
    {
        $result = $this->sdk->getPackageByProductCodeId('icwdmdcamtis');

        $this->assertTrue(is_array($result));

        $this->assertArrayHasKey('category_id'    , $result);
        $this->assertArrayHasKey('section_id'     , $result);
        $this->assertArrayHasKey('package_id'     , $result);
        $this->assertArrayHasKey('unique_id'      , $result);
        $this->assertArrayHasKey('locale'         , $result);
        $this->assertArrayHasKey('manufacturer'   , $result);
        $this->assertArrayHasKey('product_code'   , $result);
        $this->assertArrayHasKey('product_code_id', $result);
        $this->assertArrayHasKey('name'           , $result);
        $this->assertArrayHasKey('abstract'       , $result);
        $this->assertArrayHasKey('description'    , $result);
        $this->assertArrayHasKey('contexts'       , $result);
        $this->assertArrayHasKey('versions'       , $result);

        $version = array_shift($result['versions']);

        $this->assertArrayHasKey('number'         , $version);
        $this->assertArrayHasKey('released'       , $version);
        $this->assertArrayHasKey('file'           , $version);
        $this->assertArrayHasKey('changelog'      , $version);
        $this->assertArrayHasKey('requirements'   , $version);
        $this->assertArrayHasKey('download'       , $version);
        $this->assertArrayHasKey('pph'            , $version);
    }

    public function testSetAndGetPackageByUniqueId()
    {
        $result = $this->sdk->getPackageByUniqueId('1ae6bab1d1');

        $this->assertTrue(is_array($result));

        $this->assertArrayHasKey('category_id'    , $result);
        $this->assertArrayHasKey('section_id'     , $result);
        $this->assertArrayHasKey('package_id'     , $result);
        $this->assertArrayHasKey('unique_id'      , $result);
        $this->assertArrayHasKey('locale'         , $result);
        $this->assertArrayHasKey('manufacturer'   , $result);
        $this->assertArrayHasKey('product_code'   , $result);
        $this->assertArrayHasKey('product_code_id', $result);
        $this->assertArrayHasKey('name'           , $result);
        $this->assertArrayHasKey('abstract'       , $result);
        $this->assertArrayHasKey('description'    , $result);
        $this->assertArrayHasKey('contexts'       , $result);
        $this->assertArrayHasKey('versions'       , $result);

        $version = array_shift($result['versions']);

        $this->assertArrayHasKey('number'         , $version);
        $this->assertArrayHasKey('released'       , $version);
        $this->assertArrayHasKey('file'           , $version);
        $this->assertArrayHasKey('changelog'      , $version);
        $this->assertArrayHasKey('requirements'   , $version);
        $this->assertArrayHasKey('download'       , $version);
        $this->assertArrayHasKey('pph'            , $version);
    }

    public function testSetAndGetPackageCount()
    {
        $result = $this->sdk->getPackageCount('1ae6bab1d1');

        $this->assertTrue(is_numeric($result));

        $this->assertTrue($result > 0);
    }

    public function testSetAndGetPackages()
    {
        $this->markTestSkipped();
    }

    public function testSetAndGetPackagesByProductCodes()
    {
        $this->markTestSkipped();
    }

    public function testSetAndGetPackagesByProductCodeSearch()
    {
        $this->markTestSkipped();
    }

    public function testSetAndGetSectionCount()
    {
        $this->markTestSkipped();
    }

    public function testSetAndGetTimeout()
    {
        $this->sdk->setTimeout(Defaults::TIMEOUT);

        $actual = $this->sdk->getTimeout();

        $this->assertEquals(Defaults::TIMEOUT, $actual);
    }


    public function testSetAndGetVersion()
    {
        $this->sdk->setVersion(Defaults::VERSION);

        $actual = $this->sdk->getVersion();

        $this->assertEquals(Defaults::VERSION, $actual);
    }

    public function testQueryUrl()
    {
        $this->markTestSkipped();
    }

    public function testRequestUrl()
    {
        $this->markTestSkipped();
    }

}