<?php

namespace Tisd\Sdk\Lut;

use Tisd\Sdk\Exception\RuntimeException as RuntimeException;
use Tisd\Sdk;

class AbstractLut
{

    protected $sdk;
    protected $lut;

    public function __construct($options = array())
    {
        $this->setSdk(new Sdk($options));
    }

    protected function buildLut($keyName)
    {
        $ret = array();

        $packages = $this->getSdk()->getPackages();

        foreach ($packages['children'] as $categories) {
            foreach ($categories['children'] as $sections) {
                foreach ($sections['children'] as $package) {
                    if (!isset($package[$keyName])) {
                        throw new RuntimeException("The '{$keyName}' does not exist in the package.");
                    }
                    $key = $package[$keyName];
                    if (isset($ret[$key])) {
                        throw new RuntimeException("The '{$keyName}' is not unique in the LUT. The offending key is '{$key}'.");
                    } else {
                        $ret[$key] = $package;
                    }
                }
            }
        }

        return $ret;
    }

    public function getValues()
    {
        return $this->lut;
    }

    public function getKeys()
    {
        return array_keys($this->getValues());
    }

    public function getValue($key)
    {
        $ret = null;

        if (isset($this->lut[$key])) {
            $ret = $this->lut[$key];
        }

        return $ret;
    }

    public function setSdk($sdk)
    {
        $this->sdk = $sdk;

        return $this;
    }

    public function getSdk()
    {
        return $this->sdk;
    }

}