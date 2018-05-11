<?php

namespace Tisd\Sdk\Lut;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use Tisd\Sdk\Exception\RuntimeException;
use Tisd\Sdk\Sdk;

/**
 * Class AbstractLut
 *
 * @package Tisd\Sdk\Lut
 */
class AbstractLut
{
    /**
     * Instance of Sdk
     *
     * @var Sdk
     */
    protected $sdk;

    /**
     * Look-up-table
     *
     * @var array
     */
    protected $lut;

    /**
     * AbstractLut constructor
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $sdk = new Sdk($options);

        $this->setSdk($sdk);
    }

    /**
     * Get all keys in the LUT
     *
     * @return array
     */
    public function getKeys()
    {
        return array_keys($this->getValues());
    }

    /**
     * Get all data in the LUT
     *
     * @return array
     */
    public function getValues()
    {
        return $this->lut;
    }

    /**
     * Get the value for key in the LUT
     *
     * @param string $key
     *
     * @return mixed|null
     */
    public function getValue($key)
    {
        $ret = null;

        if (isset($this->lut[$key])) {
            $ret = $this->lut[$key];
        }

        return $ret;
    }

    /**
     * Get an instance of the Sdk
     *
     * @return Sdk
     */
    public function getSdk()
    {
        return $this->sdk;
    }

    /**
     * Set an instance of the Sdk
     *
     * @param Sdk $sdk
     *
     * @return $this
     */
    public function setSdk(Sdk $sdk)
    {
        $this->sdk = $sdk;

        return $this;
    }

    /**
     * Build the LUT
     *
     * @param string $keyName
     *
     * @return array
     */
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

            if (!array_key_exists($keyName, $package)) {
                $format  = "The '%s' does not exist in the package.";
                $message = sprintf($format, $keyName);
                throw new RuntimeException($message);
            }

            $key = $package[$keyName];

            if (array_key_exists($key, $ret)) {
                $format  = "The '%s' is not unique in the LUT. The offending key is '%s'.";
                $message = sprintf($format, $keyName, $key);
                throw new RuntimeException($message);
            }

            $ret[$key] = $package;
        }

        return $ret;
    }
}
