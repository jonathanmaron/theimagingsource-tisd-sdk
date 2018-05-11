<?php

namespace Tisd\Sdk\Validator;

use Tisd\Sdk\Lut\ProductCodeIdToPackage as ProductCodeIdToPackageLut;

/**
 * Class ProductCodeId
 *
 * @package Tisd\Sdk\Validator
 */
class ProductCodeId extends AbstractValidator
{
    /**
     * ProductCodeId constructor
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $lut = new ProductCodeIdToPackageLut($options);

        $this->setHaystack($lut->getKeys());
    }
}
