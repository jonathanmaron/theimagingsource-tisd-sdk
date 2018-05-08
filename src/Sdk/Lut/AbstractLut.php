<?php

namespace Tisd\Sdk\Lut;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use Tisd\Sdk;
use Tisd\Sdk\Exception\RuntimeException;

class AbstractLut
{
    protected $sdk;

    protected $lut;

    public function __construct($options = [])
    {
        $sdk = new Sdk($options);

        $this->setSdk($sdk);
    }

    public function getKeys()
    {
        return array_keys($this->getValues());
    }

    public function getValues()
    {
        return $this->lut;
    }

    public function getValue($key)
    {
        $ret = null;

        if (isset($this->lut[$key])) {
            $ret = $this->lut[$key];
        }

        return $ret;
    }

    public function getSdk()
    {
        return $this->sdk;
    }

    public function setSdk($sdk)
    {
        $this->sdk = $sdk;

        return $this;
    }

    protected function buildLut($keyName)
    {
        $ret = [];

        $packages = $this->getSdk()->getPackages();

        $rai = new RecursiveArrayIterator($packages);
        $rii = new RecursiveIteratorIterator($rai, RecursiveIteratorIterator::SELF_FIRST);

        foreach ($rii as $package) {

            if (!is_array($package)) {
                continue;
            }

            if (!array_key_exists('package_id', $package)) {
                continue;
            }

            if (!isset($package[$keyName])) {
                $format  = "The '%s' does not exist in the package.";
                $message = sprintf($format, $keyName);
                throw new RuntimeException($message);
            }

            $key = $package[$keyName];

            if (isset($ret[$key])) {
                $format  = "The '%s' is not unique in the LUT. The offending key is '%s'.";
                $message = sprintf($format, $keyName, $key);
                throw new RuntimeException($message);
            }

            $ret[$key] = $package;
        }

        return $ret;
    }
}
