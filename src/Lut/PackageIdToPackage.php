<?php

namespace Tisd\Sdk\Lut;

/**
 * Class PackageIdToPackage
 *
 * @package Tisd\Sdk\Lut
 */
class PackageIdToPackage extends AbstractLut
{
    /**
     * PackageIdToPackage constructor
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        parent::__construct($options);

        $this->lut = $this->buildLut('package_id');
    }
}
