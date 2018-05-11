<?php

namespace Tisd\Sdk\Validator;

use Tisd\Sdk\Lut\UuidToPackage as UuidToPackageLut;

/**
 * Class Uuid
 *
 * @package Tisd\Sdk\Validator
 */
class Uuid extends AbstractValidator
{
    /**
     * Uuid constructor
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $lut = new UuidToPackageLut($options);

        $this->setHaystack($lut->getKeys());
    }
}
