<?php

namespace Tisd;

trait PackagesTrait
{
    abstract protected function getConsolidated();

    public function getPackages($categoryId = null, $sectionId = null, $packageId = null)
    {
        $consolidated = $this->getConsolidated();

        $packages = $consolidated['packages'];

        if (null !== $categoryId && null !== $sectionId && null !== $packageId) {

            $this->filterPackagesByKeyValue($packages, 'category_id', $categoryId);
            $this->filterPackagesByKeyValue($packages, 'section_id', $sectionId);
            $this->filterPackagesByKeyValue($packages, 'package_id', $packageId);

            $ret = $packages['children'][$categoryId]['children'][$sectionId]['children'][$packageId];

        } elseif (null !== $categoryId && null !== $sectionId) {

            $this->filterPackagesByKeyValue($packages, 'category_id', $categoryId);
            $this->filterPackagesByKeyValue($packages, 'section_id', $sectionId);

            $ret = $packages['children'][$categoryId]['children'][$sectionId];

        } elseif (null !== $categoryId) {

            $this->filterPackagesByKeyValue($packages, 'category_id', $categoryId);

            $ret = $packages['children'][$categoryId];

        } else {

            $ret = $packages;
        }

        return $ret;
    }

    public function getPackagesByProductCodes($productCodes)
    {
        $consolidated = $this->getConsolidated();

        $packages = $consolidated['packages'];
        $key      = 'product_code';
        $value    = $productCodes;
        $fuzzy    = false;

        return $this->filterPackagesByKeyValue($packages, $key, $value, $fuzzy);
    }

    public function getPackagesByProductCodeSearch($q)
    {
        $consolidated = $this->getConsolidated();

        $packages = $consolidated['packages'];
        $key      = 'product_code';
        $value    = $q;
        $fuzzy    = true;

        return $this->filterPackagesByKeyValue($packages, $key, $value, $fuzzy);
    }

    private function filterPackagesByKeyValue(&$packages, $key, $value, $fuzzy = false)
    {
        foreach ($packages as $index => $package) {

            if (is_array($package)) {
                $packages[$index] = $this->filterPackagesByKeyValue($package, $key, $value, $fuzzy);
            }

            if (is_array($package['children'] ?? null)) {
                if (0 === count($package['children'])) {
                    unset($packages[$index]);
                }
            }

            if (!isset($package[$key])) {
                continue;
            }

            if ($fuzzy) {
                $string = substr($package[$key], 0, strlen($value));
                if (0 != strcasecmp($string, $value)) {
                    unset($packages[$index]);
                }
            } elseif (!in_array($package[$key], (array) $value)) {
                unset($packages[$index]);
            }
        }

        return $packages;
    }
}
