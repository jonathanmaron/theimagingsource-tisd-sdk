<?php

namespace Tisd\Sdk\Validator;

use Tisd\Sdk\Lut\PackageIdToPackage as PackageIdToPackageLut;

class PackageId extends AbstractValidator
{

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setLut(new PackageIdToPackageLut($options));
    }

}