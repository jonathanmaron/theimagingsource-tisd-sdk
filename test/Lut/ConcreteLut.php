<?php

namespace TisdTest\Sdk\Lut;

use Tisd\Sdk\Lut\AbstractLut as TisdSdkLutAbstractLut;

class ConcreteLut extends TisdSdkLutAbstractLut
{
    public function __construct($options = [])
    {
        parent::__construct($options);

        $this->lut = $this->buildLut('invalid_key');
    }
}
