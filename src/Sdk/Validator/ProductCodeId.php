<?php

namespace Tisd\Sdk\Validator;

use Tisd\Sdk\Lut\ProductCodeIdToPackage as ProductCodeIdToPackageLut;

class ProductCodeId extends AbstractValidator
{
    public function __construct($options = [])
    {
        parent::__construct($options);

        $this->setLut(new ProductCodeIdToPackageLut($options));
    }
}
