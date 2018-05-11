<?php

namespace Tisd\Sdk\Lut;

/**
 * Class ProductCodeToPackage
 *
 * @package Tisd\Sdk\Lut
 */
class ProductCodeToPackage extends AbstractLut
{
    /**
     * ProductCodeToPackage constructor
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        parent::__construct($options);

        $this->lut = $this->buildLut('product_code');
    }
}
