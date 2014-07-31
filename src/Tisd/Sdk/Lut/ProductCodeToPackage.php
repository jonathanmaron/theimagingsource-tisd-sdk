<?php

namespace Tisd\Sdk\Lut;

class ProductCodeToPackage extends AbstractLut
{

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->lut = $this->buildLut('product_code');
    }

}