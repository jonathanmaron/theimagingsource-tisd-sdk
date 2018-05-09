<?php

namespace Tisd\Sdk\Lut;

class ProductCodeIdToPackage extends AbstractLut
{
    public function __construct($options = [])
    {
        parent::__construct($options);

        $this->lut = $this->buildLut('product_code_id');
    }
}
