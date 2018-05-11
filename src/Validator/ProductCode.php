<?php

namespace Tisd\Sdk\Validator;

use Tisd\Sdk\Lut\ProductCodeToPackage as ProductCodeToPackageLut;

/**
 * Class ProductCode
 *
 * @package Tisd\Sdk\Validator
 */
class ProductCode extends AbstractValidator
{
    /**
     * ProductCode constructor
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $lut = new ProductCodeToPackageLut($options);

        $this->setHaystack($lut->getKeys());
    }
}
