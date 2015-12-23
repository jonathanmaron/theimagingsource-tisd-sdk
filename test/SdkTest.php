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

    public function testGetCategoryCount()
    {
        $result = $this->sdk->getCategoryCount();

        $this->assertTrue(is_numeric($result));

        $this->assertTrue($result > 3);
    }

    public function testSetAndGetContext()
    {
        $this->sdk->setContext(Defaults::CONTEXT_MACHINE_VISION);

        $actual = $this->sdk->getContext();

        $this->assertEquals(Defaults::CONTEXT_MACHINE_VISION, $actual);
    }

    public function testGetContexts()
    {
        $result = $this->sdk->getContexts();

        $this->assertTrue(is_array($result));

        $this->assertContains(Defaults::CONTEXT_MACHINE_VISION, $result);
        $this->assertContains(Defaults::CONTEXT_ASTRONOMY, $result);
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

    public function testGetPackageByPackageId()
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

    public function testGetPackageByProductCode()
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

    public function testGetPackageByProductCodeId()
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

    public function testGetPackageByUniqueId()
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

    public function testGetPackageCount()
    {
        $result = $this->sdk->getPackageCount('1ae6bab1d1');

        $this->assertTrue(is_numeric($result));

        $this->assertTrue($result > 0);
    }

    public function testGetPackagesNoParamaters()
    {
        $result = $this->sdk->getPackages();

        $this->assertTrue(is_array($result));

        $this->assertArrayHasKey('children'       , $result);

        $this->assertArrayHasKey('downloads'      , $result['children']);
        $this->assertArrayHasKey('images'         , $result['children']);
        $this->assertArrayHasKey('movies'         , $result['children']);
        $this->assertArrayHasKey('publications'   , $result['children']);

        $this->assertArrayHasKey('children'       , $result['children']['downloads']);

        $this->assertArrayHasKey('drivers'        , $result['children']['downloads']['children']);

        $this->assertArrayHasKey('children'       , $result['children']['downloads']['children']['drivers']);

        $this->assertArrayHasKey('icwdmdcamtis'   , $result['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id'    , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('section_id'     , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('package_id'     , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('unique_id'      , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('locale'         , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('manufacturer'   , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code'   , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code_id', $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('name'           , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('abstract'       , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('description'    , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('contexts'       , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('versions'       , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);

        $this->markTestSkipped();
    }

    public function testGetPackagesWithCategoryId()
    {
        $result = $this->sdk->getPackages('downloads');

        $this->assertTrue(is_array($result));

        $this->assertArrayHasKey('children'       , $result);

        $this->assertArrayHasKey('drivers'        , $result['children']);

        $this->assertArrayHasKey('children'       , $result['children']['drivers']);

        $this->assertArrayHasKey('icwdmdcamtis'   , $result['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id'    , $result['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('section_id'     , $result['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('package_id'     , $result['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('unique_id'      , $result['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('locale'         , $result['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('manufacturer'   , $result['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code'   , $result['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code_id', $result['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('name'           , $result['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('abstract'       , $result['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('description'    , $result['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('contexts'       , $result['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('versions'       , $result['children']['drivers']['children']['icwdmdcamtis']);
    }

    public function testGetPackagesWithCategoryIdAndSectionId()
    {
        $result = $this->sdk->getPackages('downloads', 'drivers');

        $this->assertTrue(is_array($result));

        $this->assertArrayHasKey('children'       , $result);

        $this->assertArrayHasKey('icwdmdcamtis'   , $result['children']);

        $this->assertArrayHasKey('category_id'    , $result['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('section_id'     , $result['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('package_id'     , $result['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('unique_id'      , $result['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('locale'         , $result['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('manufacturer'   , $result['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code'   , $result['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code_id', $result['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('name'           , $result['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('abstract'       , $result['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('description'    , $result['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('contexts'       , $result['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('versions'       , $result['children']['icwdmdcamtis']);
    }

    public function testGetPackagesWithCategoryIdAndSectionIdAndPackageId()
    {
        $result = $this->sdk->getPackages('downloads', 'drivers', 'icwdmdcamtis');

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
    }

    public function testGetPackagesByProductCodes()
    {
        $result = $this->sdk->getPackagesByProductCodes(['IC WDM DCAM TIS', 'IC WDM GIGE TIS', 'IC WDM 878 TIS']);

        $this->assertTrue(is_array($result));

        $this->assertArrayHasKey('children'       , $result);

        $this->assertArrayHasKey('downloads'      , $result['children']);

        $this->assertArrayHasKey('drivers'        , $result['children']['downloads']['children']);

        $this->assertArrayHasKey('icwdmdcamtis'   , $result['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id'    , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('section_id'     , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('package_id'     , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('unique_id'      , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('locale'         , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('manufacturer'   , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code'   , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code_id', $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('name'           , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('abstract'       , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('description'    , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('contexts'       , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('versions'       , $result['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);

        $this->assertArrayHasKey('icwdmgigetis'   , $result['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id'    , $result['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('section_id'     , $result['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('package_id'     , $result['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('unique_id'      , $result['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('locale'         , $result['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('manufacturer'   , $result['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('product_code'   , $result['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('product_code_id', $result['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('name'           , $result['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('abstract'       , $result['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('description'    , $result['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('contexts'       , $result['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('versions'       , $result['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);

        $this->assertArrayHasKey('icwdm878tis'    , $result['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id'    , $result['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('section_id'     , $result['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('package_id'     , $result['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('unique_id'      , $result['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('locale'         , $result['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('manufacturer'   , $result['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('product_code'   , $result['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('product_code_id', $result['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('name'           , $result['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('abstract'       , $result['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('description'    , $result['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('contexts'       , $result['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('versions'       , $result['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
    }

    public function testGetPackagesByProductCodeSearch()
    {
        $this->markTestSkipped();
    }

    public function testGetSectionCount()
    {
        $result = $this->sdk->getSectionCount();

        $this->assertTrue(is_numeric($result));

        $this->assertTrue($result > 30);
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