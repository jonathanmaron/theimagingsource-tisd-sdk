<?php

namespace Tisd\Sdk\Validator;

use Tisd\Sdk\Lut\PackageIdToPackage as PackageIdToPackageLut;

class PackageId extends AbstractValidator
{
    public function __construct($options = [])
    {
        $lut = new PackageIdToPackageLut($options);

        $this->setHaystack($lut->getKeys());
    }
}
