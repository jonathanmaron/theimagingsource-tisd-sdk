<?php

namespace Tisd\Sdk\Validator;

use Tisd\Sdk\Lut\ProductCodeIdToPackage as ProductCodeIdToPackageLut;

class ProductCodeId extends AbstractValidator
{
    public function __construct($options = [])
    {
        $lut = new ProductCodeIdToPackageLut($options);

        $this->setHaystack($lut->getKeys());
    }
}
