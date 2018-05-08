<?php

namespace Tisd\Sdk\Validator;

class AbstractValidator
{
    protected $lut;

    public function __construct($options = [])
    {
    }

    public function isValid($value)
    {
        $ret = false;

        if (in_array($value, $this->getLut()->getKeys())) {
            $ret = true;
        }

        return $ret;
    }

    public function getLut()
    {
        return $this->lut;
    }

    public function setLut($lut)
    {
        $this->lut = $lut;

        return $this;
    }
}
