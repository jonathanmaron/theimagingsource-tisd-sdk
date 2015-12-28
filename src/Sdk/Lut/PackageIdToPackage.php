<?php

namespace Tisd\Sdk\Lut;

class PackageIdToPackage extends AbstractLut
{
    public function __construct($options = [])
    {
        parent::__construct($options);

        $this->lut = $this->buildLut('package_id');
    }
}
