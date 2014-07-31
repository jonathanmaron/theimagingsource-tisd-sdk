<?php

namespace Tisd;

use Tisd\Sdk\Cache as TisdSdkCache;

use Tisd\Sdk\Exception\RuntimeException as RuntimeException;

class Sdk
{
    const CONTEXT_MACHINE_VISION = 'machinevision';
    const CONTEXT_ASTRONOMY      = 'astronomy';
    const CONTEXT_SCAN2DOCX      = 'scan2docx';
    const CONTEXT_SCAN2VOICE     = 'scan2voice';

    const HOSTNAME_DEVELOPMENT = 'dl.theimagingsource.com.dev';
    const HOSTNAME_PRODUCTION  = 'dl.theimagingsource.com';

    const LOCALE  = 'en_US';

    const VERSION = '2.0';

    const TIMEOUT = 10;

    protected $cache;
    protected $locale;
    protected $hostname;
    protected $version;
    protected $timeout;

    protected $filterByContext;

    public function __construct($options = array())
    {
        if (isset($options['locale'])) {
            $locale = $options['locale'];
        } else {
            $locale = self::LOCALE;
        }

        $this->setLocale($locale);


        if (isset($options['hostname'])) {
            $hostname = $options['hostname'];
        } else {
            $hostname = $this->getDefaultHostname();
        }

        $this->setHostname($hostname);


        if (isset($options['version'])) {
            $version = $options['version'];
        } else {
            $version = self::VERSION;
        }

        $this->setVersion($version);


        if (isset($options['timeout'])) {
            $timeout = $options['timeout'];
        } else {
            $timeout = self::TIMEOUT;
        }

        $this->setTimeout($timeout);


        if (isset($options['context'])) {
            $this->setFilterByContext($options['context']);
        }


        $this->setCache(new TisdSdkCache());
    }

    // --------------------------------------------------------------------------------

    protected function queryUrl($fragment)
    {
        $ret = false;

        $url = $this->buildUrl($fragment);

        if ($this->getCache()->getTtl() > 0) {

            $cacheId = $this->getCache()->getId($url);

            $ret = $this->getCache()->read($cacheId);

            if (false === $ret) {

                $ret = $this->requestUrl($url);

                $this->getCache()->write($cacheId, $ret);
            }

        } else {

            $ret = $this->requestUrl($url);
        }

        return $ret;
    }

    protected function requestUrl($url)
    {
        $context = stream_context_create(
                array(
                    'http' => array(
                        'timeout' => $this->getTimeout(),
                    )
                )
        );

        $ret = file_get_contents($url, false, $context);
        $ret = json_decode($ret, true);

        return $ret;
    }

    protected function buildUrl($fragment)
    {
        $ret = sprintf('http://%s/api/%s%s'
                , $this->getHostname()
                , $this->getVersion()
                , $fragment);

        return $ret;
    }

    // --------------------------------------------------------------------------------

    public function getMeta()
    {
        $fragment = sprintf('/meta/%s.json'
                , $this->getLocale());

        return $this->queryUrl($fragment);
    }

    public function getCategoryCount()
    {
        $meta = $this->getMeta();

        return (integer) $meta['category']['count'];
    }

    public function getSectionCount()
    {
        $meta = $this->getMeta();

        return (integer) $meta['section']['count'];
    }

    public function getPackageCount()
    {
        $meta = $this->getMeta();

        return (integer) $meta['package']['count'];
    }

    public function getBuildTime($type = 'timestamp')
    {
        $meta = $this->getMeta();

        return $meta['build']['time'][$type];
    }

    // --------------------------------------------------------------------------------

    public function getLocales()
    {
        $fragment = '/locales.json';

        return $this->queryUrl($fragment);
    }

    // --------------------------------------------------------------------------------

    protected function filterPackages($packages)
    {
        $filterApplied   = false;
        $filterByContext = $this->getFilterByContext();

        if (null !== $filterByContext) {
            $filterApplied = true;
            foreach ($packages['children'] as $categoryId => $categories) {
                foreach ($categories['children'] as $sectionId => $sections) {
                    foreach ($sections['children'] as $packageId => $package) {
                        if (!in_array($filterByContext, $package['contexts'])) {
                            unset($packages['children'][$categoryId]['children'][$sectionId]['children'][$packageId]);
                        }
                    }
                }
            }
        }

        // add further filters here...

        // remove empty arrays

        if ($filterApplied) {
            foreach ($packages['children'] as $categoryId => $categories) {
                foreach ($categories['children'] as $sectionId => $sections) {
                    if (0 == count($packages['children'][$categoryId]['children'][$sectionId]['children'])) {
                        unset($packages['children'][$categoryId]['children'][$sectionId]);
                    }
                }
                if (0 == count($packages['children'][$categoryId]['children'])) {
                    unset($packages['children'][$categoryId]);
                }
            }
        }

        return $packages;
    }

    // --------------------------------------------------------------------------------


    public function getPackages($categoryId = null, $sectionId = null, $packageId = null)
    {
        if (isset($categoryId) && isset($sectionId) && isset($packageId)) {

            $fragment = sprintf('/packages/%s/%s/%s/%s.json'
                    , $categoryId
                    , $sectionId
                    , $packageId
                    , $this->getLocale());
        } elseif (isset($categoryId) && isset($sectionId)) {

            $fragment = sprintf('/packages/%s/%s/%s.json'
                    , $categoryId
                    , $sectionId
                    , $this->getLocale());
        } elseif (isset($categoryId)) {

            $fragment = sprintf('/packages/%s/%s.json'
                    , $categoryId
                    , $this->getLocale());
        } else {

            $fragment = sprintf('/packages/%s.json'
                    , $this->getLocale());
        }

        $packages = $this->queryUrl($fragment);
        $packages = $this->filterPackages($packages);

        return $packages;
    }

    public function getPackageByUniqueId($uniqueId)
    {
        $fragment = sprintf('/get-package-by-unique-id/%s.json'
                , $uniqueId);

        return $this->queryUrl($fragment);
    }

    public function getPackageByProductCodeId($productCodeId)
    {
        $fragment = sprintf('/get-package-by-product-code-id/%s/%s.json'
                , $productCodeId
                , $this->getLocale());

        return $this->queryUrl($fragment);
    }

    public function getPackageByPackageId($packageId)
    {
        $fragment = sprintf('/get-package-by-package-id/%s/%s.json'
                , $packageId
                , $this->getLocale());

        return $this->queryUrl($fragment);
    }

    public function getPackageByProductCode($productCode)
    {
        $ret = null;

        $packages = $this->getPackages();

        foreach ($packages['children'] as $categories) {
            foreach ($categories['children'] as $sections) {
                foreach ($sections['children'] as $package) {
                    if ($productCode == $package['product_code']) {
                        $ret = $package;
                        break 3;
                    }
                }
            }
        }

        return $ret;
    }

    public function getPackagesByProductCodes($productCodes)
    {
        $packages = $this->getPackages();

        foreach ($packages['children'] as $categoryId => $categories) {
            foreach ($categories['children'] as $sectionId => $sections) {
                foreach ($sections['children'] as $packageId => $package) {
                    if (!in_array($package['product_code'], $productCodes)) {
                        unset($packages['children'][$categoryId]['children'][$sectionId]['children'][$packageId]);
                    }
                }
                if (0 === count($packages['children'][$categoryId]['children'][$sectionId]['children'])) {
                    unset($packages['children'][$categoryId]['children'][$sectionId]);
                }
            }
            if (0 === count($packages['children'][$categoryId]['children'])) {
                unset($packages['children'][$categoryId]);
            }
        }

        return $packages;
    }

    public function getPackagesByProductCodeSearch($q)
    {
        $q = strtolower($q);

        $qLen = strlen($q);

        $packages = $this->getPackages();

        foreach ($packages['children'] as $categoryId => $categories) {
            foreach ($categories['children'] as $sectionId => $sections) {
                foreach ($sections['children'] as $packageId => $package) {
                    $productCodeStart = strtolower(substr($package['product_code'], 0, $qLen));
                    if ($productCodeStart != $q) {
                        unset($packages['children'][$categoryId]['children'][$sectionId]['children'][$packageId]);
                    }
                }
                if (0 == count($packages['children'][$categoryId]['children'][$sectionId]['children'])) {
                    unset($packages['children'][$categoryId]['children'][$sectionId]);
                }
            }
            if (0 == count($packages['children'][$categoryId]['children'])) {
                unset($packages['children'][$categoryId]);
            }
        }

        return $packages;
    }

    // --------------------------------------------------------------------------------

    public function getContexts()
    {
        $fragment = sprintf('/contexts/%s.json'
                , $this->getLocale());

        return $this->queryUrl($fragment);
    }

    // --------------------------------------------------------------------------------

    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setHostname($hostname)
    {
        $this->hostname = $hostname;

        return $this;
    }

    public function getHostname()
    {
        return $this->hostname;
    }

    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function getTimeout()
    {
        return $this->timeout;
    }

    public function setCache($cache)
    {
        $this->cache = $cache;

        return $this;
    }

    public function getCache()
    {
        return $this->cache;
    }

    public function setFilterByContext($filterByContext)
    {
        $this->filterByContext = $filterByContext;

        return $this;
    }

    public function getFilterByContext()
    {
        return $this->filterByContext;
    }

    // --------------------------------------------------------------------------------

    protected function getDefaultHostname()
    {
        $hostname = gethostbyname(trim(`hostname`));

        if ('192.168' === substr($hostname, 0, 7)) {
            $ret = self::HOSTNAME_DEVELOPMENT;
        } else {
            $ret = self::HOSTNAME_PRODUCTION;
        }

        return $ret;
    }

    // --------------------------------------------------------------------------------
}