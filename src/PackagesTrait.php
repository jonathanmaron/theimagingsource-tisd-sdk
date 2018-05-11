<?php

/**
 * The Imaging Source Download System PHP Wrapper
 *
 * PHP wrapper for The Imaging Source Download System Web API. Authored and supported by The Imaging Source Europe GmbH.
 *
 * @link      http://dl-gui.theimagingsource.com to learn more about The Imaging Source Download System
 * @link      https://github.com/jonathanmaron/theimagingsource-tisd-sdk for the canonical source repository
 * @license   https://github.com/jonathanmaron/theimagingsource-tisd-sdk/blob/master/LICENSE.md
 * @copyright © 2018 The Imaging Source Europe GmbH
 */

namespace Tisd\Sdk;

/**
 * Trait PackagesTrait
 *
 * @package Tisd\Sdk
 */
trait PackagesTrait
{
    /**
     * Filter the packages by key
     *
     * @param array  $packages
     * @param string $key
     * @param string $value
     * @param bool   $fuzzy
     *
     * @return mixed
     */
    abstract protected function filter($packages, $key, $value, $fuzzy = false);

    /**
     * Get the array of consolidated data
     *
     * @return array
     */
    abstract protected function getConsolidated();

    /**
     * Get the array of packages data
     *
     * @param string|null $categoryId
     * @param string|null $sectionId
     * @param string|null $packageId
     *
     * @return mixed|null
     */
    public function getPackages($categoryId = null, $sectionId = null, $packageId = null)
    {
        $consolidated = $this->getConsolidated();

        $packages = $consolidated['packages'];

        if (null !== $categoryId && null !== $sectionId && null !== $packageId) {

            $packages = $this->filter($packages, 'category_id', $categoryId);
            $packages = $this->filter($packages, 'section_id', $sectionId);
            $packages = $this->filter($packages, 'package_id', $packageId);

            return $packages['children'][$categoryId]['children'][$sectionId]['children'][$packageId] ?? null;
        }

        if (null !== $categoryId && null !== $sectionId) {

            $packages = $this->filter($packages, 'category_id', $categoryId);
            $packages = $this->filter($packages, 'section_id', $sectionId);

            return $packages['children'][$categoryId]['children'][$sectionId] ?? null;
        }

        if (null !== $categoryId) {

            $packages = $this->filter($packages, 'category_id', $categoryId);

            return $packages['children'][$categoryId] ?? null;
        }

        return $packages;
    }

    /**
     * Get array of package data for the specified product codes
     *
     * @param array $productCodes
     *
     * @return mixed
     */
    public function getPackagesByProductCodes($productCodes)
    {
        $consolidated = $this->getConsolidated();

        return $this->filter($consolidated['packages'], 'product_code', $productCodes);
    }

    /**
     * Get array of package data for the specified search term (starting with)
     *
     * @param string $q
     *
     * @return mixed
     */
    public function getPackagesByProductCodeSearch($q)
    {
        $consolidated = $this->getConsolidated();

        return $this->filter($consolidated['packages'], 'product_code', $q, true);
    }
}
