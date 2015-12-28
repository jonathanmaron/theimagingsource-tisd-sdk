<?php

namespace Tisd;

use Tisd\Sdk\Cache as TisdSdkCache;

class Sdk
{
    protected $cache;

    public function __construct($options = [])
    {
        $optionKeys = [
            'locale',
            'context',
            'hostname',
            'version',
            'timeout',
        ];

        foreach ($optionKeys as $optionKey) {
            if (isset($options[$optionKey])) {
                $methodName = 'set' . ucfirst($optionKey);
                $this->$methodName($options[$optionKey]);
            }
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
        $options = [
            'http' => [
                'timeout' => $this->getTimeout(),
            ],
        ];

        $context = stream_context_create($options);

        $ret = file_get_contents($url, false, $context);
        $ret = json_decode($ret, true);

        return $ret;
    }

    protected function buildUrl($fragment)
    {
        $ret = sprintf('http://%s/api/%s%s', $this->getHostname(), $this->getVersion(), $fragment);

        return $ret;
    }

    // --------------------------------------------------------------------------------

    public function getMeta()
    {
        $fragment = sprintf('/meta/%s.json', $this->getLocale());

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

    protected function filterPackages(&$array)
    {
        if (null !== $this->getContext()) {

            foreach ($array as $key => $item) {

                if (is_array($item)) {
                    $array[$key] = $this->filterPackages($item);    //   set via parent
                }

                if (isset($item['children']) && is_array($item['children'])) {
                    if (0 === count($item['children'])) {
                        unset($array[$key]);                        // unset via parent
                    }
                }

                if (isset($item['contexts']) && is_array($item['contexts'])) {
                    if (!in_array($this->getContext(), $item['contexts'])) {
                        unset($array[$key]);                        // unset via parent
                    }
                }
            }
        }

        return $array;
    }

    // --------------------------------------------------------------------------------

    public function getPackages($categoryId = null, $sectionId = null, $packageId = null)
    {
        if (null !== $categoryId && null !== $sectionId && null !== $packageId) {
            $fragment = sprintf('/packages/%s/%s/%s/%s.json', $categoryId, $sectionId, $packageId, $this->getLocale());
        } elseif (null !== $categoryId && null !== $sectionId) {
            $fragment = sprintf('/packages/%s/%s/%s.json', $categoryId, $sectionId, $this->getLocale());
        } elseif (null !== $categoryId) {
            $fragment = sprintf('/packages/%s/%s.json', $categoryId, $this->getLocale());
        } else {
            $fragment = sprintf('/packages/%s.json', $this->getLocale());
        }

        $packages = $this->queryUrl($fragment);

        $packages = $this->filterPackages($packages);

        return $packages;
    }

    public function getPackageByUniqueId($uniqueId)
    {
        $fragment = sprintf('/get-package-by-unique-id/%s.json', $uniqueId);

        return $this->queryUrl($fragment);
    }

    public function getPackageByProductCodeId($productCodeId)
    {
        $fragment = sprintf('/get-package-by-product-code-id/%s/%s.json', $productCodeId, $this->getLocale());

        return $this->queryUrl($fragment);
    }

    public function getPackageByPackageId($packageId)
    {
        $fragment = sprintf('/get-package-by-package-id/%s/%s.json', $packageId, $this->getLocale());

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
        $fragment = sprintf('/contexts/%s.json', $this->getLocale());

        return $this->queryUrl($fragment);
    }

    // --------------------------------------------------------------------------------

    public function setCache($cache)
    {
        $this->cache = $cache;

        return $this;
    }

    public function getCache()
    {
        return $this->cache;
    }

    // --------------------------------------------------------------------------------

    // proxy methods to Defaults

    public function setLocale($locale)
    {
        Defaults::setLocale($locale);

        return $this;
    }

    public function getLocale()
    {
        return Defaults::getLocale();
    }

    public function setHostname($hostname)
    {
        Defaults::setHostname($hostname);

        return $this;
    }

    public function getHostname()
    {
        return Defaults::getHostname();
    }

    public function setVersion($version)
    {
        Defaults::setVersion($version);

        return $this;
    }

    public function getVersion()
    {
        return Defaults::getVersion();
    }

    public function setTimeout($timeout)
    {
        Defaults::setTimeout($timeout);

        return $this;
    }

    public function getTimeout()
    {
        return Defaults::getTimeout();
    }

    public function setContext($context)
    {
        Defaults::setContext($context);

        return $this;
    }

    public function getContext()
    {
        return Defaults::getContext();
    }

    // --------------------------------------------------------------------------------
}
