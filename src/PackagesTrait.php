<?php
declare(strict_types=1);

/**
 * The Imaging Source Download System PHP Wrapper
 *
 * PHP wrapper for The Imaging Source Download System Web API. Authored and supported by The Imaging Source Europe GmbH.
 *
 * @link      http://dl-gui.theimagingsource.com to learn more about The Imaging Source Download System
 * @link      https://github.com/jonathanmaron/theimagingsource-tisd-sdk for the canonical source repository
 * @license   https://github.com/jonathanmaron/theimagingsource-tisd-sdk/blob/master/LICENSE.md
 * @copyright © 2022 The Imaging Source Europe GmbH
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
     * @param array        $packages
     * @param string       $key
     * @param array|string $value
     * @param bool         $fuzzy
     *
     * @return array
     */
    abstract protected function filter(array $packages, string $key, array|string $value, bool $fuzzy = false): array;

    /**
     * Get the array of consolidated data
     *
     * @return array
     */
    abstract protected function getConsolidated(): array;

    /**
     * Get the array of packages data
     *
     * @param string $categoryId
     * @param string $sectionId
     * @param string $packageId
     *
     * @return array
     */
    public function getPackages(string $categoryId = '', string $sectionId = '', string $packageId = ''): array
    {
        $consolidated = $this->getConsolidated();

        $packages = $consolidated['packages'];

        if ('' !== $categoryId && '' !== $sectionId && '' !== $packageId) {

            $packages = $this->filter($packages, 'category_id', $categoryId);
            $packages = $this->filter($packages, 'section_id', $sectionId);
            $packages = $this->filter($packages, 'package_id', $packageId);

            if (isset($packages['children'][$categoryId]['children'][$sectionId]['children'][$packageId])) {
                return $packages['children'][$categoryId]['children'][$sectionId]['children'][$packageId];
            }

            return [];
        }

        if ('' !== $categoryId && '' !== $sectionId) {

            $packages = $this->filter($packages, 'category_id', $categoryId);
            $packages = $this->filter($packages, 'section_id', $sectionId);

            if (isset($packages['children'][$categoryId]['children'][$sectionId])) {
                return $packages['children'][$categoryId]['children'][$sectionId];
            }

            return [];
        }

        if ('' !== $categoryId) {

            $packages = $this->filter($packages, 'category_id', $categoryId);

            if (isset($packages['children'][$categoryId])) {
                return $packages['children'][$categoryId];
            }

            return [];
        }

        return $packages;
    }

    /**
     * Get array of package data for the specified product codes
     *
     * @param array $productCodes
     *
     * @return array
     */
    public function getPackagesByProductCodes(array $productCodes): array
    {
        $consolidated = $this->getConsolidated();

        return $this->filter($consolidated['packages'], 'product_code', $productCodes);
    }

    /**
     * Get array of package data for the specified search term (starting with)
     *
     * @param string $q
     *
     * @return array
     */
    public function getPackagesByProductCodeSearch(string $q): array
    {
        $consolidated = $this->getConsolidated();

        return $this->filter($consolidated['packages'], 'product_code', $q, true);
    }

    /**
     * Get array of package data for the specified platform ID
     *
     * @param string $platformId
     * @return array
     */
    public function getPackagesByPlatformId(string $platformId): array
    {
        $consolidated = $this->getConsolidated();

        return $this->filter($consolidated['packages'], 'platform_id', $platformId);
    }
}
