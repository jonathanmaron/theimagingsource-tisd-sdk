<?php

namespace TisdTest\Sdk;

use PHPUnit_Framework_TestCase;
use Tisd\Sdk;
use Tisd\Sdk\Cache;
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

    public function testPurgeCacheOnce()
    {
        $this->sdk->getCache()->purge();
    }

    public function testConstruct()
    {
        $sdk = new Sdk(
            [
                'locale'   => Defaults::LOCALE,
                'context'  => Defaults::CONTEXT_MACHINE_VISION,
                'hostname' => Defaults::HOSTNAME_PRODUCTION,
                'version'  => Defaults::VERSION,
                'timeout'  => Defaults::TIMEOUT,
            ]
        );

        $this->assertEquals(Defaults::LOCALE                 , $sdk->getLocale());
        $this->assertEquals(Defaults::CONTEXT_MACHINE_VISION , $sdk->getContext());
        $this->assertEquals(Defaults::HOSTNAME_PRODUCTION    , $sdk->getHostname());
        $this->assertEquals(Defaults::VERSION                , $sdk->getVersion());
        $this->assertEquals(Defaults::TIMEOUT                , $sdk->getTimeout());
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
        $cache = new Cache();

        $this->sdk->setCache($cache);

        $actual = $this->sdk->getCache();

        $this->assertEquals($cache, $actual);

    }

    public function testGetCategoryCount()
    {
        $actual = $this->sdk->getCategoryCount();

        $this->assertTrue(is_numeric($actual));

        $this->assertTrue($actual > 3);
    }

    public function testSetAndGetContext()
    {
        $this->sdk->setContext(Defaults::CONTEXT_MACHINE_VISION);

        $actual = $this->sdk->getContext();

        $this->assertEquals(Defaults::CONTEXT_MACHINE_VISION, $actual);
    }

    public function testGetContexts()
    {
        $actual = $this->sdk->getContexts();

        $this->assertTrue(is_array($actual));

        $this->assertContains(Defaults::CONTEXT_MACHINE_VISION, $actual);
        $this->assertContains(Defaults::CONTEXT_ASTRONOMY, $actual);
    }

    public function testSetAndGetHostname()
    {
        $this->sdk->setHostname(Defaults::HOSTNAME_PRODUCTION);

        $actual = $this->sdk->getHostname();

        $this->assertEquals(Defaults::HOSTNAME_PRODUCTION, $actual);
    }

    public function testSetAndGetLocale()
    {
        $this->sdk->setLocale(Defaults::LOCALE);

        $actual = $this->sdk->getLocale();

        $this->assertEquals(Defaults::LOCALE, $actual);
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

    public function testGetPackageByPackageId()
    {
        $actual = $this->sdk->getPackageByPackageId('icwdmdcamtis');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('category_id'    , $actual);
        $this->assertArrayHasKey('section_id'     , $actual);
        $this->assertArrayHasKey('package_id'     , $actual);
        $this->assertArrayHasKey('unique_id'      , $actual);
        $this->assertArrayHasKey('locale'         , $actual);
        $this->assertArrayHasKey('manufacturer'   , $actual);
        $this->assertArrayHasKey('product_code'   , $actual);
        $this->assertArrayHasKey('product_code_id', $actual);
        $this->assertArrayHasKey('name'           , $actual);
        $this->assertArrayHasKey('abstract'       , $actual);
        $this->assertArrayHasKey('description'    , $actual);
        $this->assertArrayHasKey('contexts'       , $actual);
        $this->assertArrayHasKey('versions'       , $actual);

        $version = array_shift($actual['versions']);

        $this->assertArrayHasKey('number'         , $version);
        $this->assertArrayHasKey('released'       , $version);
        $this->assertArrayHasKey('file'           , $version);
        $this->assertArrayHasKey('changelog'      , $version);
        $this->assertArrayHasKey('requirements'   , $version);
        $this->assertArrayHasKey('download'       , $version);
        $this->assertArrayHasKey('pph'            , $version);
    }

    public function testGetPackageByProductCode()
    {
        $actual = $this->sdk->getPackageByProductCode('IC WDM DCAM TIS');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('category_id'    , $actual);
        $this->assertArrayHasKey('section_id'     , $actual);
        $this->assertArrayHasKey('package_id'     , $actual);
        $this->assertArrayHasKey('unique_id'      , $actual);
        $this->assertArrayHasKey('locale'         , $actual);
        $this->assertArrayHasKey('manufacturer'   , $actual);
        $this->assertArrayHasKey('product_code'   , $actual);
        $this->assertArrayHasKey('product_code_id', $actual);
        $this->assertArrayHasKey('name'           , $actual);
        $this->assertArrayHasKey('abstract'       , $actual);
        $this->assertArrayHasKey('description'    , $actual);
        $this->assertArrayHasKey('contexts'       , $actual);
        $this->assertArrayHasKey('versions'       , $actual);

        $version = array_shift($actual['versions']);

        $this->assertArrayHasKey('number'         , $version);
        $this->assertArrayHasKey('released'       , $version);
        $this->assertArrayHasKey('file'           , $version);
        $this->assertArrayHasKey('changelog'      , $version);
        $this->assertArrayHasKey('requirements'   , $version);
        $this->assertArrayHasKey('download'       , $version);
        $this->assertArrayHasKey('pph'            , $version);
    }

    public function GetPackageByProductCodeInvalidProductCode()
    {
        $actual = $this->sdk->getPackageByProductCode('INVALID PRODUCT CODE');

        $this->assertNull($actual);
    }

    public function testGetPackageByProductCodeId()
    {
        $actual = $this->sdk->getPackageByProductCodeId('icwdmdcamtis');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('category_id'    , $actual);
        $this->assertArrayHasKey('section_id'     , $actual);
        $this->assertArrayHasKey('package_id'     , $actual);
        $this->assertArrayHasKey('unique_id'      , $actual);
        $this->assertArrayHasKey('locale'         , $actual);
        $this->assertArrayHasKey('manufacturer'   , $actual);
        $this->assertArrayHasKey('product_code'   , $actual);
        $this->assertArrayHasKey('product_code_id', $actual);
        $this->assertArrayHasKey('name'           , $actual);
        $this->assertArrayHasKey('abstract'       , $actual);
        $this->assertArrayHasKey('description'    , $actual);
        $this->assertArrayHasKey('contexts'       , $actual);
        $this->assertArrayHasKey('versions'       , $actual);

        $version = array_shift($actual['versions']);

        $this->assertArrayHasKey('number'         , $version);
        $this->assertArrayHasKey('released'       , $version);
        $this->assertArrayHasKey('file'           , $version);
        $this->assertArrayHasKey('changelog'      , $version);
        $this->assertArrayHasKey('requirements'   , $version);
        $this->assertArrayHasKey('download'       , $version);
        $this->assertArrayHasKey('pph'            , $version);
    }

    public function testGetPackageByUniqueId()
    {
        $actual = $this->sdk->getPackageByUniqueId('1ae6bab1d1');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('category_id'    , $actual);
        $this->assertArrayHasKey('section_id'     , $actual);
        $this->assertArrayHasKey('package_id'     , $actual);
        $this->assertArrayHasKey('unique_id'      , $actual);
        $this->assertArrayHasKey('locale'         , $actual);
        $this->assertArrayHasKey('manufacturer'   , $actual);
        $this->assertArrayHasKey('product_code'   , $actual);
        $this->assertArrayHasKey('product_code_id', $actual);
        $this->assertArrayHasKey('name'           , $actual);
        $this->assertArrayHasKey('abstract'       , $actual);
        $this->assertArrayHasKey('description'    , $actual);
        $this->assertArrayHasKey('contexts'       , $actual);
        $this->assertArrayHasKey('versions'       , $actual);

        $version = array_shift($actual['versions']);

        $this->assertArrayHasKey('number'         , $version);
        $this->assertArrayHasKey('released'       , $version);
        $this->assertArrayHasKey('file'           , $version);
        $this->assertArrayHasKey('changelog'      , $version);
        $this->assertArrayHasKey('requirements'   , $version);
        $this->assertArrayHasKey('download'       , $version);
        $this->assertArrayHasKey('pph'            , $version);
    }

    public function testGetPackageCount()
    {
        $actual = $this->sdk->getPackageCount('1ae6bab1d1');

        $this->assertTrue(is_numeric($actual));

        $this->assertTrue($actual > 0);
    }

    public function testGetPackagesNoParamaters()
    {
        $actual = $this->sdk->getPackages();

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('children'       , $actual);

        $this->assertArrayHasKey('downloads'      , $actual['children']);
        $this->assertArrayHasKey('images'         , $actual['children']);
        $this->assertArrayHasKey('movies'         , $actual['children']);
        $this->assertArrayHasKey('publications'   , $actual['children']);

        $this->assertArrayHasKey('children'       , $actual['children']['downloads']);

        $this->assertArrayHasKey('drivers'        , $actual['children']['downloads']['children']);

        $this->assertArrayHasKey('children'       , $actual['children']['downloads']['children']['drivers']);

        $this->assertArrayHasKey('icwdmdcamtis'   , $actual['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id'    , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('section_id'     , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('package_id'     , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('unique_id'      , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('locale'         , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('manufacturer'   , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code'   , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code_id', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('name'           , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('abstract'       , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('description'    , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('contexts'       , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('versions'       , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);

        $this->markTestSkipped();
    }

    public function testGetPackagesWithCategoryId()
    {
        $actual = $this->sdk->getPackages('downloads');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('children'       , $actual);

        $this->assertArrayHasKey('drivers'        , $actual['children']);

        $this->assertArrayHasKey('children'       , $actual['children']['drivers']);

        $this->assertArrayHasKey('icwdmdcamtis'   , $actual['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id'    , $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('section_id'     , $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('package_id'     , $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('unique_id'      , $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('locale'         , $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('manufacturer'   , $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code'   , $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code_id', $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('name'           , $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('abstract'       , $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('description'    , $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('contexts'       , $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('versions'       , $actual['children']['drivers']['children']['icwdmdcamtis']);
    }

    public function testGetPackagesWithCategoryIdAndSectionId()
    {
        $actual = $this->sdk->getPackages('downloads', 'drivers');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('children'       , $actual);

        $this->assertArrayHasKey('icwdmdcamtis'   , $actual['children']);

        $this->assertArrayHasKey('category_id'    , $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('section_id'     , $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('package_id'     , $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('unique_id'      , $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('locale'         , $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('manufacturer'   , $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code'   , $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code_id', $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('name'           , $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('abstract'       , $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('description'    , $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('contexts'       , $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('versions'       , $actual['children']['icwdmdcamtis']);
    }

    public function testGetPackagesWithCategoryIdAndSectionIdAndPackageId()
    {
        $actual = $this->sdk->getPackages('downloads', 'drivers', 'icwdmdcamtis');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('category_id'    , $actual);
        $this->assertArrayHasKey('section_id'     , $actual);
        $this->assertArrayHasKey('package_id'     , $actual);
        $this->assertArrayHasKey('unique_id'      , $actual);
        $this->assertArrayHasKey('locale'         , $actual);
        $this->assertArrayHasKey('manufacturer'   , $actual);
        $this->assertArrayHasKey('product_code'   , $actual);
        $this->assertArrayHasKey('product_code_id', $actual);
        $this->assertArrayHasKey('name'           , $actual);
        $this->assertArrayHasKey('abstract'       , $actual);
        $this->assertArrayHasKey('description'    , $actual);
        $this->assertArrayHasKey('contexts'       , $actual);
        $this->assertArrayHasKey('versions'       , $actual);
    }

    public function testGetPackagesByProductCodes()
    {
        $actual = $this->sdk->getPackagesByProductCodes(['IC WDM DCAM TIS', 'IC WDM GIGE TIS', 'IC WDM 878 TIS']);

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('children'       , $actual);

        $this->assertArrayHasKey('downloads'      , $actual['children']);

        $this->assertArrayHasKey('drivers'        , $actual['children']['downloads']['children']);

        $this->assertArrayHasKey('icwdmdcamtis'   , $actual['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id'    , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('section_id'     , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('package_id'     , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('unique_id'      , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('locale'         , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('manufacturer'   , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code'   , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code_id', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('name'           , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('abstract'       , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('description'    , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('contexts'       , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('versions'       , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);

        $this->assertArrayHasKey('icwdmgigetis'   , $actual['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id'    , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('section_id'     , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('package_id'     , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('unique_id'      , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('locale'         , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('manufacturer'   , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('product_code'   , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('product_code_id', $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('name'           , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('abstract'       , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('description'    , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('contexts'       , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('versions'       , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);

        $this->assertArrayHasKey('icwdm878tis'    , $actual['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id'    , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('section_id'     , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('package_id'     , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('unique_id'      , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('locale'         , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('manufacturer'   , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('product_code'   , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('product_code_id', $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('name'           , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('abstract'       , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('description'    , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('contexts'       , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('versions'       , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
    }

    public function testGetPackagesByProductCodeSearch()
    {
        $actual = $this->sdk->getPackagesByProductCodeSearch('IC WDM');

        $this->assertTrue(is_array($actual));


        $this->assertArrayHasKey('children'       , $actual);

        $this->assertArrayHasKey('downloads'      , $actual['children']);

        $this->assertArrayHasKey('drivers'        , $actual['children']['downloads']['children']);

        $this->assertArrayHasKey('icwdmdcamtis'   , $actual['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id'    , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('section_id'     , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('package_id'     , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('unique_id'      , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('locale'         , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('manufacturer'   , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code'   , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code_id', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('name'           , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('abstract'       , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('description'    , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('contexts'       , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('versions'       , $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);

        $this->assertArrayHasKey('icwdmgigetis'   , $actual['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id'    , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('section_id'     , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('package_id'     , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('unique_id'      , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('locale'         , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('manufacturer'   , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('product_code'   , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('product_code_id', $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('name'           , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('abstract'       , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('description'    , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('contexts'       , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('versions'       , $actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);

        $this->assertArrayHasKey('icwdm878tis'    , $actual['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id'    , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('section_id'     , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('package_id'     , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('unique_id'      , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('locale'         , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('manufacturer'   , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('product_code'   , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('product_code_id', $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('name'           , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('abstract'       , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('description'    , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('contexts'       , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('versions'       , $actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);

    }

    public function testGetSectionCount()
    {
        $actual = $this->sdk->getSectionCount();

        $this->assertTrue(is_numeric($actual));

        $this->assertTrue($actual > 30);
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