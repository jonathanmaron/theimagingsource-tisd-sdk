<?php

namespace Tisd\Sdk\Lut;

/**
 * Class UuidToPackage
 *
 * @package Tisd\Sdk\Lut
 */
class UuidToPackage extends AbstractLut
{
    /**
     * UuidToPackage constructor
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        parent::__construct($options);

        $this->lut = $this->buildLut('uuid');
    }
}
