<?php

namespace Tisd\Sdk\Validator;

use Tisd\Sdk\Lut\UuidToPackage as UuidToPackageLut;

class Uuid extends AbstractValidator
{
    public function __construct($options = [])
    {
        $lut = new UuidToPackageLut($options);

        $this->setLut($lut);
    }
}
