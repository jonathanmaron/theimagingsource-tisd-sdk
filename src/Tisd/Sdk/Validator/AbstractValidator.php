<?php

namespace Tisd\Sdk\Validator;

class AbstractValidator
{

    protected $lut;

    public function __construct($options = array())
    {

    }

    public function isValid($value)
    {
        $ret = false;

        if (in_array($value, array_keys($this->getLut()->getValues()))) {
            $ret = true;
        }

        return $ret;
    }

    public function setLut($lut)
    {
        $this->lut = $lut;

        return $this;
    }

    public function getLut()
    {
        return $this->lut;
    }

}