<?php

namespace Tisd\Sdk\Lut;

class UuidToPackage extends AbstractLut
{
    public function __construct($options = [])
    {
        parent::__construct($options);

        $this->lut = $this->buildLut('uuid');
    }
}
