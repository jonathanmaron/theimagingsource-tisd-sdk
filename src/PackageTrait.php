<?php

namespace Tisd\Sdk;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;

/**
 * Trait PackageTrait
 *
 * @package Tisd\Sdk
 */
trait PackageTrait
{
    /**
     * Get the array of consolidated data
     *
     * @return array
     */
    abstract protected function getConsolidated();

    /**
     * Get array of package data matching uuid
     *
     * @param string $uuid
     *
     * @return array|null
     */
    public function getPackageByUuid($uuid)
    {
        return $this->getPackageByKeyValue('uuid', $uuid);
    }

    /**
     * Get array of package data matching product code ID
     *
     * @param string $productCodeId
     *
     * @return array|null
     */
    public function getPackageByProductCodeId($productCodeId)
    {
        return $this->getPackageByKeyValue('product_code_id', $productCodeId);
    }

    /**
     * Get array of package data matching package ID
     *
     * @param string $packageId
     *
     * @return array|null
     */
    public function getPackageByPackageId($packageId)
    {
        return $this->getPackageByKeyValue('package_id', $packageId);
    }

    /**
     * Get array of package data matching product code
     *
     * @param string $productCode
     *
     * @return array|null
     */
    public function getPackageByProductCode($productCode)
    {
        return $this->getPackageByKeyValue('product_code', $productCode);
    }

    /**
     * Get array of package data where specified $key equals specified $value
     *
     * @param string $key
     * @param string $value
     *
     * @return array|null
     */
    private function getPackageByKeyValue($key, $value)
    {
        $consolidated = $this->getConsolidated();

        $rai = new RecursiveArrayIterator($consolidated['packages']);
        $rii = new RecursiveIteratorIterator($rai, RecursiveIteratorIterator::SELF_FIRST);

        foreach ($rii as $package) {

            if (!is_array($package)) {
                continue;
            }

            if (!array_key_exists('package_id', $package)) {
                continue;
            }

            if ($package[$key] === $value) {
                return $package;
            }
        }

        return null;
    }
}
