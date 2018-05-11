<?php

namespace Tisd\Sdk\Validator;

class AbstractValidator
{
    /**
     * Array of valid strings
     *
     * @var array
     */
    protected $haystack;

    /**
     * Return true, if $value is valid. False otherwise.
     *
     * @param $value
     *
     * @return bool
     */
    public function isValid($value)
    {
        return in_array($value, $this->getHaystack());
    }

    /**
     * Return the array of valid strings
     *
     * @return array
     */
    protected function getHaystack()
    {
        return $this->haystack;
    }

    /**
     * Set the array of valid strings
     *
     * @param array $haystack
     *
     * @return $this
     */
    protected function setHaystack($haystack)
    {
        $this->haystack = $haystack;

        return $this;
    }
}
