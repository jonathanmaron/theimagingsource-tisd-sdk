<?php

namespace Tisd\Sdk\Lut;

class UniqueIdToPackage extends AbstractLut
{

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->lut = $this->buildLut('unique_id');
    }

}