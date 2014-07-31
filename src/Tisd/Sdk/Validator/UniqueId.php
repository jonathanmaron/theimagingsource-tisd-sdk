<?php

namespace Tisd\Sdk\Validator;

use Tisd\Sdk\Lut\UniqueIdToPackage as UniqueIdToPackageLut;

class UniqueId extends AbstractValidator
{

    public function __construct($options = array())
    {
        parent::__construct($options);
        
        $this->setLut(new UniqueIdToPackageLut($options));
    }

}