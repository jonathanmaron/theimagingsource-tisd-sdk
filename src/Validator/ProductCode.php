<?php

namespace Tisd\Sdk\Validator;

use Tisd\Sdk\Lut\ProductCodeToPackage as ProductCodeToPackageLut;

class ProductCode extends AbstractValidator
{
    public function __construct($options = [])
    {
        $lut = new ProductCodeToPackageLut($options);

        $this->setHaystack($lut->getKeys());
    }
}
