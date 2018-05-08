<?php

namespace Tisd\Sdk\Validator;

class AbstractValidator
{
    protected $lut;

    public function isValid($value)
    {
        $ret = false;

        if (in_array($value, $this->getLut()->getKeys())) {
            $ret = true;
        }

        return $ret;
    }

    protected function getLut()
    {
        return $this->lut;
    }

    protected function setLut($lut)
    {
        $this->lut = $lut;

        return $this;
    }
}
