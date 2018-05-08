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

            $packages = $this->filter($packages, 'category_id', $categoryId);
            $packages = $this->filter($packages, 'section_id', $sectionId);
            $packages = $this->filter($packages, 'package_id', $packageId);

            return $packages['children'][$categoryId]['children'][$sectionId]['children'][$packageId];

        } elseif (null !== $categoryId && null !== $sectionId) {

            $packages = $this->filter($packages, 'category_id', $categoryId);
            $packages = $this->filter($packages, 'section_id', $sectionId);

            return $packages['children'][$categoryId]['children'][$sectionId];

        } elseif (null !== $categoryId) {

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
