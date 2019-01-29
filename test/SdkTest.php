<?php
declare(strict_types=1);

namespace TisdTest\Sdk;

use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\TestCase;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use Tisd\Sdk\Cache\Cache;
use Tisd\Sdk\Defaults\Defaults;
use Tisd\Sdk\Exception\InvalidArgumentException;
use Tisd\Sdk\Sdk;

class SdkTest extends TestCase
{
    protected $sdk;

    protected function setUp(): void
    {
        $options = [
            //'hostname' => Defaults::HOSTNAME_DEVELOPMENT,
        ];

        $this->sdk = new Sdk($options);
    }

    protected function tearDown(): void
    {
        unset($this->sdk);
    }

    public function testConstructWithOptionsArray(): void
    {
        $timeout = random_int(10, 100);
        $ttl     = random_int(10, 100);
        $locale  = 'de_DE';

        $options = [
            'locale'   => $locale,
            'context'  => Defaults::CONTEXT_MACHINE_VISION,
            'hostname' => Defaults::HOSTNAME_PRODUCTION,
            'version'  => Defaults::VERSION,
            'timeout'  => $timeout,
            'ttl'      => $ttl,
        ];

        $sdk = new Sdk($options);

        $this->assertEquals($locale, $sdk->getLocale());
        $this->assertEquals(Defaults::CONTEXT_MACHINE_VISION, $sdk->getContext());
        $this->assertEquals(Defaults::HOSTNAME_PRODUCTION, $sdk->getHostname());
        $this->assertEquals(Defaults::VERSION, $sdk->getVersion());
        $this->assertEquals($timeout, $sdk->getTimeout());
        $this->assertEquals($ttl, $sdk->getCache()->getTtl());

        unset($sdk);
    }

    public function testPurgeAndWithDisabledCache(): void
    {
        $this->sdk->getCache()->purge();

        $this->sdk->getCache()->setTtl(0);

        $actual = $this->sdk->getPackages();

        $this->assertTrue(is_array($actual));
    }

    public function testSetAndGetBuildTime(): void
    {
        $actual = $this->sdk->getBuildTime();

        $this->assertTrue(is_int($actual));
    }

    public function testSetAndGetCache(): void
    {
        $cache = new Cache();

        $this->sdk->setCache($cache);

        $actual = $this->sdk->getCache();

        $this->assertEquals($cache, $actual);
    }

    public function testGetCategoryCount(): void
    {
        $actual = $this->sdk->getCategoryCount();

        $this->assertTrue(is_int($actual));

        $this->assertTrue($actual > 3);
    }

    public function testSetAndGetContext(): void
    {
        $this->sdk->setContext(Defaults::CONTEXT_MACHINE_VISION);

        $actual = $this->sdk->getContext();

        $this->assertEquals(Defaults::CONTEXT_MACHINE_VISION, $actual);
    }

    public function testGetContexts(): void
    {
        $actual = $this->sdk->getContexts();

        $this->assertTrue(is_array($actual));

        $this->assertContains(Defaults::CONTEXT_MACHINE_VISION, $actual);
        $this->assertContains(Defaults::CONTEXT_ASTRONOMY, $actual);
    }

    public function testSetAndGetHostname(): void
    {
        $this->sdk->setHostname(Defaults::HOSTNAME_PRODUCTION);

        $actual = $this->sdk->getHostname();

        $this->assertEquals(Defaults::HOSTNAME_PRODUCTION, $actual);
    }

    public function testSetAndGetLocale(): void
    {
        $this->sdk->setLocale(Defaults::LOCALE);

        $actual = $this->sdk->getLocale();

        $this->assertEquals(Defaults::LOCALE, $actual);
    }

    public function testSetAndGetLocales(): void
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

    public function testSetAndGetMeta(): void
    {
        $actual = $this->sdk->getMeta();

        $this->assertArrayHasKey('category', $actual);
        $this->assertArrayHasKey('section', $actual);
        $this->assertArrayHasKey('package', $actual);
        $this->assertArrayHasKey('total', $actual);
        $this->assertArrayHasKey('build', $actual);
    }

    public function testGetPackageByPackageId(): void
    {
        $actual = $this->sdk->getPackageByPackageId('icwdmdcamtis');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('category_id', $actual);
        $this->assertArrayHasKey('section_id', $actual);
        $this->assertArrayHasKey('package_id', $actual);
        $this->assertArrayHasKey('uuid', $actual);
        $this->assertArrayHasKey('locale', $actual);
        $this->assertArrayHasKey('manufacturer', $actual);
        $this->assertArrayHasKey('product_code', $actual);
        $this->assertArrayHasKey('product_code_id', $actual);
        $this->assertArrayHasKey('name', $actual);
        $this->assertArrayHasKey('abstract', $actual);
        $this->assertArrayHasKey('description', $actual);
        $this->assertArrayHasKey('contexts', $actual);
        $this->assertArrayHasKey('versions', $actual);

        $version = array_shift($actual['versions']);

        $this->assertArrayHasKey('number', $version);
        $this->assertArrayHasKey('released', $version);
        $this->assertArrayHasKey('file', $version);
        $this->assertArrayHasKey('changelog', $version);
        $this->assertArrayHasKey('requirements', $version);
        $this->assertArrayHasKey('download', $version);
        $this->assertArrayHasKey('pph', $version);
    }

    public function testGetPackageByProductCode(): void
    {
        $actual = $this->sdk->getPackageByProductCode('IC WDM DCAM TIS');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('category_id', $actual);
        $this->assertArrayHasKey('section_id', $actual);
        $this->assertArrayHasKey('package_id', $actual);
        $this->assertArrayHasKey('uuid', $actual);
        $this->assertArrayHasKey('locale', $actual);
        $this->assertArrayHasKey('manufacturer', $actual);
        $this->assertArrayHasKey('product_code', $actual);
        $this->assertArrayHasKey('product_code_id', $actual);
        $this->assertArrayHasKey('name', $actual);
        $this->assertArrayHasKey('abstract', $actual);
        $this->assertArrayHasKey('description', $actual);
        $this->assertArrayHasKey('contexts', $actual);
        $this->assertArrayHasKey('versions', $actual);

        $version = array_shift($actual['versions']);

        $this->assertArrayHasKey('number', $version);
        $this->assertArrayHasKey('released', $version);
        $this->assertArrayHasKey('file', $version);
        $this->assertArrayHasKey('changelog', $version);
        $this->assertArrayHasKey('requirements', $version);
        $this->assertArrayHasKey('download', $version);
        $this->assertArrayHasKey('pph', $version);
    }

    public function testGetPackageByProductCodeInvalidProductCode(): void
    {
        $this->sdk->getCache()->purge();

        $actual = $this->sdk->getPackageByProductCode('INVALID PRODUCT CODE');

        $this->assertNull($actual);
    }

    public function testGetPackageByProductCodeId(): void
    {
        $actual = $this->sdk->getPackageByProductCodeId('icwdmdcamtis');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('category_id', $actual);
        $this->assertArrayHasKey('section_id', $actual);
        $this->assertArrayHasKey('package_id', $actual);
        $this->assertArrayHasKey('uuid', $actual);
        $this->assertArrayHasKey('locale', $actual);
        $this->assertArrayHasKey('manufacturer', $actual);
        $this->assertArrayHasKey('product_code', $actual);
        $this->assertArrayHasKey('product_code_id', $actual);
        $this->assertArrayHasKey('name', $actual);
        $this->assertArrayHasKey('abstract', $actual);
        $this->assertArrayHasKey('description', $actual);
        $this->assertArrayHasKey('contexts', $actual);
        $this->assertArrayHasKey('versions', $actual);

        $version = array_shift($actual['versions']);

        $this->assertArrayHasKey('number', $version);
        $this->assertArrayHasKey('released', $version);
        $this->assertArrayHasKey('file', $version);
        $this->assertArrayHasKey('changelog', $version);
        $this->assertArrayHasKey('requirements', $version);
        $this->assertArrayHasKey('download', $version);
        $this->assertArrayHasKey('pph', $version);
    }

    public function testGetPackageByUuid(): void
    {
        $actual = $this->sdk->getPackageByUuid('2b5a907d-5eb0-538b-87ff-1a36bb76c92f');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('category_id', $actual);
        $this->assertArrayHasKey('section_id', $actual);
        $this->assertArrayHasKey('package_id', $actual);
        $this->assertArrayHasKey('uuid', $actual);
        $this->assertArrayHasKey('locale', $actual);
        $this->assertArrayHasKey('manufacturer', $actual);
        $this->assertArrayHasKey('product_code', $actual);
        $this->assertArrayHasKey('product_code_id', $actual);
        $this->assertArrayHasKey('name', $actual);
        $this->assertArrayHasKey('abstract', $actual);
        $this->assertArrayHasKey('description', $actual);
        $this->assertArrayHasKey('contexts', $actual);
        $this->assertArrayHasKey('versions', $actual);

        $version = array_shift($actual['versions']);

        $this->assertArrayHasKey('number', $version);
        $this->assertArrayHasKey('released', $version);
        $this->assertArrayHasKey('file', $version);
        $this->assertArrayHasKey('changelog', $version);
        $this->assertArrayHasKey('requirements', $version);
        $this->assertArrayHasKey('download', $version);
        $this->assertArrayHasKey('pph', $version);
    }

    public function testGetPackageCount(): void
    {
        $actual = $this->sdk->getPackageCount();

        $this->assertTrue(is_int($actual));

        $this->assertTrue($actual > 0);
    }

    // @codingStandardsIgnoreStart

    public function testGetPackagesNoParameters(): void
    {
        $actual = $this->sdk->getPackages();

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('children', $actual);

        $this->assertArrayHasKey('downloads', $actual['children']);
        $this->assertArrayHasKey('images', $actual['children']);
        $this->assertArrayHasKey('movies', $actual['children']);
        $this->assertArrayHasKey('publications', $actual['children']);

        $this->assertArrayHasKey('children', $actual['children']['downloads']);
        $this->assertArrayHasKey('drivers', $actual['children']['downloads']['children']);
        $this->assertArrayHasKey('children', $actual['children']['downloads']['children']['drivers']);

        $this->assertArrayHasKey('icwdmdcamtis', $actual['children']['downloads']['children']['drivers']['children']);
        $this->assertArrayHasKey('category_id', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('section_id', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('package_id', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('uuid', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('locale', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('manufacturer', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code_id', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('name', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('abstract', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('description', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('contexts', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('versions', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
    }

    public function testGetPackagesWithCategoryId(): void
    {
        $actual = $this->sdk->getPackages('downloads');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('children', $actual);

        $this->assertArrayHasKey('drivers', $actual['children']);

        $this->assertArrayHasKey('children', $actual['children']['drivers']);

        $this->assertArrayHasKey('icwdmdcamtis', $actual['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id', $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('section_id', $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('package_id', $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('uuid', $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('locale', $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('manufacturer', $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code', $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code_id', $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('name', $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('abstract', $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('description', $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('contexts', $actual['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('versions', $actual['children']['drivers']['children']['icwdmdcamtis']);
    }

    public function testGetPackagesWithCategoryIdAndSectionId(): void
    {
        $actual = $this->sdk->getPackages('downloads', 'drivers');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('children', $actual);

        $this->assertArrayHasKey('icwdmdcamtis', $actual['children']);

        $this->assertArrayHasKey('category_id', $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('section_id', $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('package_id', $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('uuid', $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('locale', $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('manufacturer', $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code', $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code_id', $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('name', $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('abstract', $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('description', $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('contexts', $actual['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('versions', $actual['children']['icwdmdcamtis']);
    }

    public function testGetPackagesWithCategoryIdAndSectionIdAndPackageId(): void
    {
        $actual = $this->sdk->getPackages('downloads', 'drivers', 'icwdmdcamtis');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('category_id', $actual);
        $this->assertArrayHasKey('section_id', $actual);
        $this->assertArrayHasKey('package_id', $actual);
        $this->assertArrayHasKey('uuid', $actual);
        $this->assertArrayHasKey('locale', $actual);
        $this->assertArrayHasKey('manufacturer', $actual);
        $this->assertArrayHasKey('product_code', $actual);
        $this->assertArrayHasKey('product_code_id', $actual);
        $this->assertArrayHasKey('name', $actual);
        $this->assertArrayHasKey('abstract', $actual);
        $this->assertArrayHasKey('description', $actual);
        $this->assertArrayHasKey('contexts', $actual);
        $this->assertArrayHasKey('versions', $actual);
    }

    public function testGetPackagesByProductCodes(): void
    {
        $actual = $this->sdk->getPackagesByProductCodes(['IC WDM DCAM TIS', 'IC WDM GIGE TIS', 'IC WDM 878 TIS']);

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('children', $actual);

        $this->assertArrayHasKey('downloads', $actual['children']);

        $this->assertArrayNotHasKey('images', $actual['children']);
        $this->assertArrayNotHasKey('publications', $actual['children']);
        $this->assertArrayNotHasKey('movies', $actual['children']);

        $this->assertArrayHasKey('drivers', $actual['children']['downloads']['children']);

        $this->assertArrayNotHasKey('enduser', $actual['children']['downloads']['children']);
        $this->assertArrayNotHasKey('extensions', $actual['children']['downloads']['children']);
        $this->assertArrayNotHasKey('firmware', $actual['children']['downloads']['children']);
        $this->assertArrayNotHasKey('samples', $actual['children']['downloads']['children']);
        $this->assertArrayNotHasKey('tools', $actual['children']['downloads']['children']);

        $this->assertArrayHasKey('icwdmdcamtis', $actual['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('section_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('package_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('uuid',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('locale',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('manufacturer',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('name',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('abstract',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('description',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('contexts',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('versions',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);

        $this->assertArrayHasKey('icwdmgigetis', $actual['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('section_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('package_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('uuid',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('locale',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('manufacturer',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('product_code',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('product_code_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('name',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('abstract',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('description',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('contexts',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('versions',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);

        $this->assertArrayHasKey('icwdm878tis', $actual['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('section_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('package_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('uuid',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('locale',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('manufacturer',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('product_code',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('product_code_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('name',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('abstract',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('description',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('contexts',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('versions',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
    }

    public function testGetPackagesByProductCodeSearch(): void
    {
        $actual = $this->sdk->getPackagesByProductCodeSearch('IC WDM');

        $this->assertTrue(is_array($actual));

        $this->assertArrayHasKey('children', $actual);

        $this->assertArrayHasKey('downloads', $actual['children']);

        $this->assertArrayNotHasKey('images', $actual['children']);
        $this->assertArrayNotHasKey('publications', $actual['children']);
        $this->assertArrayNotHasKey('movies', $actual['children']);

        $this->assertArrayHasKey('drivers', $actual['children']['downloads']['children']);

        $this->assertArrayNotHasKey('enduser', $actual['children']['downloads']['children']);
        $this->assertArrayNotHasKey('extensions', $actual['children']['downloads']['children']);
        $this->assertArrayNotHasKey('firmware', $actual['children']['downloads']['children']);
        $this->assertArrayNotHasKey('samples', $actual['children']['downloads']['children']);
        $this->assertArrayNotHasKey('tools', $actual['children']['downloads']['children']);

        $this->assertArrayHasKey('icwdmdcamtis', $actual['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('section_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('package_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('uuid',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('locale',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('manufacturer',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('product_code_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('name',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('abstract',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('description',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('contexts',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        $this->assertArrayHasKey('versions',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);

        $this->assertArrayHasKey('icwdmgigetis', $actual['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('section_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('package_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('uuid',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('locale',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('manufacturer',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('product_code',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('product_code_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('name',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('abstract',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('description',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('contexts',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        $this->assertArrayHasKey('versions',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);

        $this->assertArrayHasKey('icwdm878tis', $actual['children']['downloads']['children']['drivers']['children']);

        $this->assertArrayHasKey('category_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('section_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('package_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('uuid',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('locale',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('manufacturer',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('product_code',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('product_code_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('name',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('abstract',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('description',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('contexts',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        $this->assertArrayHasKey('versions',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
    }

    // @codingStandardsIgnoreEnd

    public function testGetSectionCount(): void
    {
        $actual = $this->sdk->getSectionCount();

        $this->assertTrue(is_int($actual));

        $this->assertTrue($actual > 30);
    }

    public function testSetAndGetTimeout(): void
    {
        $this->sdk->setTimeout(Defaults::TIMEOUT);

        $actual = $this->sdk->getTimeout();

        $this->assertEquals(Defaults::TIMEOUT, $actual);
    }

    public function testSetAndGetVersion(): void
    {
        $this->sdk->setVersion(Defaults::VERSION);

        $actual = $this->sdk->getVersion();

        $this->assertEquals(Defaults::VERSION, $actual);
    }

    public function testContextReturnsFilteredPackages(): void
    {
        $contexts = [
            Defaults::CONTEXT_ASTRONOMY,
            Defaults::CONTEXT_MACHINE_VISION,
            Defaults::CONTEXT_MICROSCOPY,
            Defaults::CONTEXT_SCAN2DOCX,
            Defaults::CONTEXT_SCAN2VOICE,
        ];

        foreach ($contexts as $context) {

            // context can only be set once per instance
            // hence we make a clone here

            $sdk = clone $this->sdk;

            $sdk->setContext($context);

            $rai = new RecursiveArrayIterator($sdk->getPackages());
            $rii = new RecursiveIteratorIterator($rai, RecursiveIteratorIterator::SELF_FIRST);

            foreach ($rii as $package) {
                if (!is_array($package)) {
                    continue;
                }
                if (!array_key_exists('package_id', $package)) {
                    continue;
                }
                $this->assertContains($context, $package['contexts']);
            }
        }
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetBuildTimeThrowsException(): void
    {
        $this->sdk->getBuildTime('invalid');
    }
}
