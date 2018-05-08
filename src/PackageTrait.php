<?php

namespace Tisd;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;

trait PackageTrait
{
    abstract protected function getConsolidated();

    public function getPackageByUuid($uuid)
    {
        return $this->getPackageByKeyValue('uuid', $uuid);
    }

    public function getPackageByProductCodeId($productCodeId)
    {
        return $this->getPackageByKeyValue('product_code_id', $productCodeId);
    }

    public function getPackageByPackageId($packageId)
    {
        return $this->getPackageByKeyValue('package_id', $packageId);
    }

    public function getPackageByProductCode($productCode)
    {
        return $this->getPackageByKeyValue('product_code', $productCode);
    }

    private function getPackageByKeyValue($key, $value)
    {
        $ret = null;

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
                $ret = $package;
                break;
            }
        }

        return $ret;
    }
}
