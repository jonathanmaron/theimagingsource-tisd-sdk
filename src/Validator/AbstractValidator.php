<?php

namespace Tisd\Sdk\Validator;

class AbstractValidator
{
    protected $haystack;

    public function isValid($value)
    {
        return in_array($value, $this->getHaystack());
    }

    protected function getHaystack()
    {
        return $this->haystack;
    }

    protected function setHaystack($haystack)
    {
        $this->haystack = $haystack;

        return $this;
    }
}
