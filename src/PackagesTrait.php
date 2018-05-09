<?php

namespace Tisd\Sdk;

trait PackagesTrait
{
    abstract protected function filter($packages, $key, $value, $fuzzy = false);

    abstract protected function getConsolidated();

    public function getPackages($categoryId = null, $sectionId = null, $packageId = null)
    {
        $consolidated = $this->getConsolidated();

        $packages = $consolidated['packages'];

        if (null !== $categoryId && null !== $sectionId && null !== $packageId) {

            $packages = $this->filter($packages, 'category_id', $categoryId);
            $packages = $this->filter($packages, 'section_id', $sectionId);
            $packages = $this->filter($packages, 'package_id', $packageId);

            return $packages['children'][$categoryId]['children'][$sectionId]['children'][$packageId];
        }

        if (null !== $categoryId && null !== $sectionId) {

            $packages = $this->filter($packages, 'category_id', $categoryId);
            $packages = $this->filter($packages, 'section_id', $sectionId);

            return $packages['children'][$categoryId]['children'][$sectionId];
        }

        if (null !== $categoryId) {

            $packages = $this->filter($packages, 'category_id', $categoryId);

            return $packages['children'][$categoryId];
        }

        return $packages;
    }

    public function getPackagesByProductCodes($productCodes)
    {
        $consolidated = $this->getConsolidated();

        return $this->filter($consolidated['packages'], 'product_code', $productCodes);
    }

    public function getPackagesByProductCodeSearch($q)
    {
        $consolidated = $this->getConsolidated();

        return $this->filter($consolidated['packages'], 'product_code', $q, true);
    }
}
