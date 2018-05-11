<?php

/**
 * The Imaging Source Download System PHP Wrapper
 *
 * PHP wrapper for The Imaging Source Download System Web API. Authored and supported by The Imaging Source Europe GmbH.
 *
 * @link      http://dl-gui.theimagingsource.com to learn more about The Imaging Source Download System
 * @link      https://github.com/jonathanmaron/theimagingsource-tisd-sdk for the canonical source repository
 * @license   https://github.com/jonathanmaron/theimagingsource-tisd-sdk/blob/master/LICENSE.md
 * @copyright © 2018 The Imaging Source Europe GmbH
 */

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
