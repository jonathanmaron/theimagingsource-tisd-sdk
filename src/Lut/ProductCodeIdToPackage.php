<?php

namespace Tisd\Sdk\Lut;

/**
 * Class ProductCodeIdToPackage
 *
 * @package Tisd\Sdk\Lut
 */
class ProductCodeIdToPackage extends AbstractLut
{
    /**
     * ProductCodeIdToPackage constructor
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        parent::__construct($options);

        $this->lut = $this->buildLut('product_code_id');
    }
}
