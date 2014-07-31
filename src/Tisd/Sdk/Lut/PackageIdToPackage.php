<?php

namespace Tisd\Sdk\Lut;

class PackageIdToPackage extends AbstractLut
{

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->lut = $this->buildLut('package_id');
    }

}