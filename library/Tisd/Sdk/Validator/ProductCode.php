<?php

namespace Tisd\Sdk\Validator;

use Tisd\Sdk\Lut\ProductCodeToPackage as ProductCodeToPackageLut;

class ProductCode extends AbstractValidator
{

    public function __construct($options = array())
    {
        parent::__construct($options);
        
        $this->setLut(new ProductCodeToPackageLut($options));
    }

}