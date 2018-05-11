<?php

namespace Tisd\Sdk\Validator;

use Tisd\Sdk\Lut\PackageIdToPackage as PackageIdToPackageLut;

/**
 * Class PackageId
 *
 * @package Tisd\Sdk\Validator
 */
class PackageId extends AbstractValidator
{
    /**
     * PackageId constructor
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $lut = new PackageIdToPackageLut($options);

        $this->setHaystack($lut->getKeys());
    }
}
