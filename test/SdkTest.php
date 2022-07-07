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
    protected Sdk $sdk;

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

        self::assertEquals($locale, $sdk->getLocale());
        self::assertEquals(Defaults::CONTEXT_MACHINE_VISION, $sdk->getContext());
        self::assertEquals(Defaults::HOSTNAME_PRODUCTION, $sdk->getHostname());
        self::assertEquals(Defaults::VERSION, $sdk->getVersion());
        self::assertEquals($timeout, $sdk->getTimeout());
        self::assertEquals($ttl, $sdk->getCache()->getTtl());

        unset($sdk);
    }

    public function testPurgeAndWithDisabledCache(): void
    {
        $this->sdk->getCache()->purge();

        $this->sdk->getCache()->setTtl(0);

        $actual = $this->sdk->getPackages();

        self::assertNotEmpty($actual);
    }

    public function testSetAndGetBuildTime(): void
    {
        $expected = strtotime('-1 year');
        $actual   = $this->sdk->getBuildTime();

        self::assertGreaterThan($expected, $actual);
    }

    public function testSetAndGetCache(): void
    {
        $cache = new Cache();

        $this->sdk->setCache($cache);

        $actual = $this->sdk->getCache();

        self::assertEquals($cache, $actual);
    }

    public function testGetCategoryCount(): void
    {
        $actual = $this->sdk->getCategoryCount();

        self::assertTrue($actual > 3);
    }

    public function testSetAndGetContext(): void
    {
        $this->sdk->setContext(Defaults::CONTEXT_MACHINE_VISION);

        $actual = $this->sdk->getContext();

        self::assertEquals(Defaults::CONTEXT_MACHINE_VISION, $actual);
    }

    public function testGetContexts(): void
    {
        $actual = $this->sdk->getContexts();

        self::assertContains(Defaults::CONTEXT_MACHINE_VISION, $actual);
        self::assertContains(Defaults::CONTEXT_ASTRONOMY, $actual);
    }

    public function testSetAndGetHostname(): void
    {
        $this->sdk->setHostname(Defaults::HOSTNAME_PRODUCTION);

        $actual = $this->sdk->getHostname();

        self::assertEquals(Defaults::HOSTNAME_PRODUCTION, $actual);
    }

    public function testSetAndGetLocale(): void
    {
        $this->sdk->setLocale(Defaults::LOCALE);

        $actual = $this->sdk->getLocale();

        self::assertEquals(Defaults::LOCALE, $actual);
    }

    public function testSetAndGetLocales(): void
    {
        $actual = $this->sdk->getLocales();

        self::assertArrayHasKey('de_DE', $actual);
        self::assertArrayHasKey('en_US', $actual);
        self::assertArrayHasKey('zh_CN', $actual);
        self::assertArrayHasKey('zh_TW', $actual);

        self::assertContains('Deutsch', $actual);
        self::assertContains('English', $actual);
        self::assertContains('简体中文', $actual);
        self::assertContains('繁體中文', $actual);
    }

    public function testSetAndGetMeta(): void
    {
        $actual = $this->sdk->getMeta();

        self::assertArrayHasKey('category', $actual);
        self::assertArrayHasKey('section', $actual);
        self::assertArrayHasKey('package', $actual);
        self::assertArrayHasKey('total', $actual);
        self::assertArrayHasKey('build', $actual);
    }

    public function testGetPackageByPackageId(): void
    {
        $actual = $this->sdk->getPackageByPackageId('icwdmdcamtis');

        self::assertArrayHasKey('category_id', $actual);
        self::assertArrayHasKey('section_id', $actual);
        self::assertArrayHasKey('package_id', $actual);
        self::assertArrayHasKey('uuid', $actual);
        self::assertArrayHasKey('locale', $actual);
        self::assertArrayHasKey('manufacturer', $actual);
        self::assertArrayHasKey('product_code', $actual);
        self::assertArrayHasKey('product_code_id', $actual);
        self::assertArrayHasKey('name', $actual);
        self::assertArrayHasKey('abstract', $actual);
        self::assertArrayHasKey('description', $actual);
        self::assertArrayHasKey('contexts', $actual);
        self::assertArrayHasKey('versions', $actual);

        $version = array_shift($actual['versions']);

        self::assertArrayHasKey('number', $version);
        self::assertArrayHasKey('released', $version);
        self::assertArrayHasKey('file', $version);
        self::assertArrayHasKey('changelog', $version);
        self::assertArrayHasKey('requirements', $version);
        self::assertArrayHasKey('download', $version);
        self::assertArrayHasKey('pph', $version);
    }

    public function testGetPackageByProductCode(): void
    {
        $actual = $this->sdk->getPackageByProductCode('IC WDM DCAM TIS');

        self::assertArrayHasKey('category_id', $actual);
        self::assertArrayHasKey('section_id', $actual);
        self::assertArrayHasKey('package_id', $actual);
        self::assertArrayHasKey('uuid', $actual);
        self::assertArrayHasKey('locale', $actual);
        self::assertArrayHasKey('manufacturer', $actual);
        self::assertArrayHasKey('product_code', $actual);
        self::assertArrayHasKey('product_code_id', $actual);
        self::assertArrayHasKey('name', $actual);
        self::assertArrayHasKey('abstract', $actual);
        self::assertArrayHasKey('description', $actual);
        self::assertArrayHasKey('contexts', $actual);
        self::assertArrayHasKey('versions', $actual);

        $version = array_shift($actual['versions']);

        self::assertArrayHasKey('number', $version);
        self::assertArrayHasKey('released', $version);
        self::assertArrayHasKey('file', $version);
        self::assertArrayHasKey('changelog', $version);
        self::assertArrayHasKey('requirements', $version);
        self::assertArrayHasKey('download', $version);
        self::assertArrayHasKey('pph', $version);
    }

    public function testGetPackageByProductCodeInvalidProductCode(): void
    {
        $this->sdk->getCache()->purge();

        $actual = $this->sdk->getPackageByProductCode('INVALID PRODUCT CODE');

        self::assertEmpty($actual);
    }

    public function testGetPackageByProductCodeId(): void
    {
        $actual = $this->sdk->getPackageByProductCodeId('icwdmdcamtis');

        self::assertArrayHasKey('category_id', $actual);
        self::assertArrayHasKey('section_id', $actual);
        self::assertArrayHasKey('package_id', $actual);
        self::assertArrayHasKey('uuid', $actual);
        self::assertArrayHasKey('locale', $actual);
        self::assertArrayHasKey('manufacturer', $actual);
        self::assertArrayHasKey('product_code', $actual);
        self::assertArrayHasKey('product_code_id', $actual);
        self::assertArrayHasKey('name', $actual);
        self::assertArrayHasKey('abstract', $actual);
        self::assertArrayHasKey('description', $actual);
        self::assertArrayHasKey('contexts', $actual);
        self::assertArrayHasKey('versions', $actual);

        $version = array_shift($actual['versions']);

        self::assertArrayHasKey('number', $version);
        self::assertArrayHasKey('released', $version);
        self::assertArrayHasKey('file', $version);
        self::assertArrayHasKey('changelog', $version);
        self::assertArrayHasKey('requirements', $version);
        self::assertArrayHasKey('download', $version);
        self::assertArrayHasKey('pph', $version);
    }

    public function testGetPackageByUuid(): void
    {
        $actual = $this->sdk->getPackageByUuid('2b5a907d-5eb0-538b-87ff-1a36bb76c92f');

        self::assertArrayHasKey('category_id', $actual);
        self::assertArrayHasKey('section_id', $actual);
        self::assertArrayHasKey('package_id', $actual);
        self::assertArrayHasKey('uuid', $actual);
        self::assertArrayHasKey('locale', $actual);
        self::assertArrayHasKey('manufacturer', $actual);
        self::assertArrayHasKey('product_code', $actual);
        self::assertArrayHasKey('product_code_id', $actual);
        self::assertArrayHasKey('name', $actual);
        self::assertArrayHasKey('abstract', $actual);
        self::assertArrayHasKey('description', $actual);
        self::assertArrayHasKey('contexts', $actual);
        self::assertArrayHasKey('versions', $actual);

        $version = array_shift($actual['versions']);

        self::assertArrayHasKey('number', $version);
        self::assertArrayHasKey('released', $version);
        self::assertArrayHasKey('file', $version);
        self::assertArrayHasKey('changelog', $version);
        self::assertArrayHasKey('requirements', $version);
        self::assertArrayHasKey('download', $version);
        self::assertArrayHasKey('pph', $version);
    }

    public function testGetPackageCount(): void
    {
        $actual = $this->sdk->getPackageCount();

        self::assertTrue($actual > 0);
    }

    // @codingStandardsIgnoreStart

    public function testGetPackagesNoParameters(): void
    {
        $actual = $this->sdk->getPackages();

        self::assertArrayHasKey('children', $actual);

        self::assertArrayHasKey('downloads', $actual['children']);
        self::assertArrayHasKey('images', $actual['children']);
        self::assertArrayHasKey('movies', $actual['children']);
        self::assertArrayHasKey('publications', $actual['children']);

        self::assertArrayHasKey('children', $actual['children']['downloads']);
        self::assertArrayHasKey('drivers', $actual['children']['downloads']['children']);
        self::assertArrayHasKey('children', $actual['children']['downloads']['children']['drivers']);

        self::assertArrayHasKey('icwdmdcamtis', $actual['children']['downloads']['children']['drivers']['children']);
        self::assertArrayHasKey('category_id', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('section_id', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('package_id', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('uuid', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('locale', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('manufacturer', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('product_code', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('product_code_id', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('name', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('abstract', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('description', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('contexts', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('versions', $actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
    }

    public function testGetPackagesWithCategoryId(): void
    {
        $actual = $this->sdk->getPackages('downloads');

        self::assertArrayHasKey('children', $actual);

        self::assertArrayHasKey('drivers', $actual['children']);

        self::assertArrayHasKey('children', $actual['children']['drivers']);

        self::assertArrayHasKey('icwdmdcamtis', $actual['children']['drivers']['children']);

        self::assertArrayHasKey('category_id', $actual['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('section_id', $actual['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('package_id', $actual['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('uuid', $actual['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('locale', $actual['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('manufacturer', $actual['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('product_code', $actual['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('product_code_id', $actual['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('name', $actual['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('abstract', $actual['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('description', $actual['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('contexts', $actual['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('versions', $actual['children']['drivers']['children']['icwdmdcamtis']);
    }

    public function testGetPackagesWithCategoryIdAndSectionId(): void
    {
        $actual = $this->sdk->getPackages('downloads', 'drivers');

        self::assertArrayHasKey('children', $actual);

        self::assertArrayHasKey('icwdmdcamtis', $actual['children']);

        self::assertArrayHasKey('category_id', $actual['children']['icwdmdcamtis']);
        self::assertArrayHasKey('section_id', $actual['children']['icwdmdcamtis']);
        self::assertArrayHasKey('package_id', $actual['children']['icwdmdcamtis']);
        self::assertArrayHasKey('uuid', $actual['children']['icwdmdcamtis']);
        self::assertArrayHasKey('locale', $actual['children']['icwdmdcamtis']);
        self::assertArrayHasKey('manufacturer', $actual['children']['icwdmdcamtis']);
        self::assertArrayHasKey('product_code', $actual['children']['icwdmdcamtis']);
        self::assertArrayHasKey('product_code_id', $actual['children']['icwdmdcamtis']);
        self::assertArrayHasKey('name', $actual['children']['icwdmdcamtis']);
        self::assertArrayHasKey('abstract', $actual['children']['icwdmdcamtis']);
        self::assertArrayHasKey('description', $actual['children']['icwdmdcamtis']);
        self::assertArrayHasKey('contexts', $actual['children']['icwdmdcamtis']);
        self::assertArrayHasKey('versions', $actual['children']['icwdmdcamtis']);
    }

    public function testGetPackagesWithCategoryIdAndSectionIdAndPackageId(): void
    {
        $actual = $this->sdk->getPackages('downloads', 'drivers', 'icwdmdcamtis');

        self::assertArrayHasKey('category_id', $actual);
        self::assertArrayHasKey('section_id', $actual);
        self::assertArrayHasKey('package_id', $actual);
        self::assertArrayHasKey('uuid', $actual);
        self::assertArrayHasKey('locale', $actual);
        self::assertArrayHasKey('manufacturer', $actual);
        self::assertArrayHasKey('product_code', $actual);
        self::assertArrayHasKey('product_code_id', $actual);
        self::assertArrayHasKey('name', $actual);
        self::assertArrayHasKey('abstract', $actual);
        self::assertArrayHasKey('description', $actual);
        self::assertArrayHasKey('contexts', $actual);
        self::assertArrayHasKey('versions', $actual);
    }

    public function testGetPackagesByProductCodes(): void
    {
        $actual = $this->sdk->getPackagesByProductCodes(['IC WDM DCAM TIS', 'IC WDM GIGE TIS', 'IC WDM 878 TIS']);

        self::assertArrayHasKey('children', $actual);

        self::assertArrayHasKey('downloads', $actual['children']);

        self::assertArrayNotHasKey('images', $actual['children']);
        self::assertArrayNotHasKey('publications', $actual['children']);
        self::assertArrayNotHasKey('movies', $actual['children']);

        self::assertArrayHasKey('drivers', $actual['children']['downloads']['children']);

        self::assertArrayNotHasKey('enduser', $actual['children']['downloads']['children']);
        self::assertArrayNotHasKey('extensions', $actual['children']['downloads']['children']);
        self::assertArrayNotHasKey('firmware', $actual['children']['downloads']['children']);
        self::assertArrayNotHasKey('samples', $actual['children']['downloads']['children']);
        self::assertArrayNotHasKey('tools', $actual['children']['downloads']['children']);

        self::assertArrayHasKey('icwdmdcamtis', $actual['children']['downloads']['children']['drivers']['children']);

        self::assertArrayHasKey('category_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('section_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('package_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('uuid',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('locale',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('manufacturer',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('product_code',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('product_code_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('name',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('abstract',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('description',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('contexts',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('versions',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);

        self::assertArrayHasKey('icwdmgigetis', $actual['children']['downloads']['children']['drivers']['children']);

        self::assertArrayHasKey('category_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('section_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('package_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('uuid',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('locale',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('manufacturer',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('product_code',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('product_code_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('name',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('abstract',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('description',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('contexts',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('versions',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);

        self::assertArrayHasKey('icwdm878tis', $actual['children']['downloads']['children']['drivers']['children']);

        self::assertArrayHasKey('category_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('section_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('package_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('uuid',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('locale',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('manufacturer',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('product_code',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('product_code_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('name',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('abstract',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('description',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('contexts',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('versions',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
    }

    public function testGetPackagesByProductCodeSearch(): void
    {
        $actual = $this->sdk->getPackagesByProductCodeSearch('IC WDM');

        self::assertArrayHasKey('children', $actual);

        self::assertArrayHasKey('downloads', $actual['children']);

        self::assertArrayNotHasKey('images', $actual['children']);
        self::assertArrayNotHasKey('publications', $actual['children']);
        self::assertArrayNotHasKey('movies', $actual['children']);

        self::assertArrayHasKey('drivers', $actual['children']['downloads']['children']);

        self::assertArrayNotHasKey('enduser', $actual['children']['downloads']['children']);
        self::assertArrayNotHasKey('extensions', $actual['children']['downloads']['children']);
        self::assertArrayNotHasKey('firmware', $actual['children']['downloads']['children']);
        self::assertArrayNotHasKey('samples', $actual['children']['downloads']['children']);
        self::assertArrayNotHasKey('tools', $actual['children']['downloads']['children']);

        self::assertArrayHasKey('icwdmdcamtis', $actual['children']['downloads']['children']['drivers']['children']);

        self::assertArrayHasKey('category_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('section_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('package_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('uuid',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('locale',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('manufacturer',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('product_code',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('product_code_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('name',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('abstract',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('description',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('contexts',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);
        self::assertArrayHasKey('versions',$actual['children']['downloads']['children']['drivers']['children']['icwdmdcamtis']);

        self::assertArrayHasKey('icwdmgigetis', $actual['children']['downloads']['children']['drivers']['children']);

        self::assertArrayHasKey('category_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('section_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('package_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('uuid',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('locale',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('manufacturer',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('product_code',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('product_code_id',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('name',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('abstract',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('description',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('contexts',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);
        self::assertArrayHasKey('versions',$actual['children']['downloads']['children']['drivers']['children']['icwdmgigetis']);

        self::assertArrayHasKey('icwdm878tis', $actual['children']['downloads']['children']['drivers']['children']);

        self::assertArrayHasKey('category_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('section_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('package_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('uuid',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('locale',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('manufacturer',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('product_code',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('product_code_id',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('name',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('abstract',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('description',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('contexts',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
        self::assertArrayHasKey('versions',$actual['children']['downloads']['children']['drivers']['children']['icwdm878tis']);
    }

    // @codingStandardsIgnoreEnd

    public function testGetSectionCount(): void
    {
        $actual = $this->sdk->getSectionCount();

        self::assertTrue($actual > 30);
    }

    public function testSetAndGetTimeout(): void
    {
        $this->sdk->setTimeout(Defaults::TIMEOUT);

        $actual = $this->sdk->getTimeout();

        self::assertEquals(Defaults::TIMEOUT, $actual);
    }

    public function testSetAndGetVersion(): void
    {
        $this->sdk->setVersion(Defaults::VERSION);

        $actual = $this->sdk->getVersion();

        self::assertEquals(Defaults::VERSION, $actual);
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
                self::assertContains($context, $package['contexts']);
            }
        }
    }

    public function testGetBuildTimeThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->sdk->getBuildTime('invalid');
    }
}
