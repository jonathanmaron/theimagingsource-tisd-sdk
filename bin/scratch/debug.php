<?php

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Load JSON from disk
 *
 * @return array
 */
function get_array()
{
    $json = file_get_contents(__DIR__ . '/en_US.json');
    $ret  = json_decode($json, true);

    return $ret;
}

/**
 * Filter raw array into array of packages
 *
 * @param $array
 *
 * @return array
 */
function get_packages($array)
{
    $ret = [];

    $mode = RecursiveIteratorIterator::SELF_FIRST;

    $rai = new RecursiveArrayIterator($array);
    $rii = new RecursiveIteratorIterator($rai, $mode);

    foreach ($rii as $package) {

        if (!is_array($package)) {
            continue;
        }

        if (!array_key_exists('package_id', $package)) {
            continue;
        }

        array_push($ret, $package);
    }

    return $ret;
}

/**
 * Structure package arrays into LUT structure
 *
 * @param $packages
 *
 * @return array
 */
function get_luts($packages)
{
    $ret = [
        'uuid'            => [],
        'product_code'    => [],
        'product_code_id' => [],
        'package_id'      => [],
    ];

    $keys = array_keys($ret);

    foreach ($packages as $package) {
        foreach ($keys as $key1) {
            if (!array_key_exists($key1, $package)) {
                continue;
            }
            $key2              = $package[$key1];
            $ret[$key1][$key2] = $package;
        }
    }

    return $ret;
}

$array    = get_array();
$packages = get_packages($array);
$luts     = get_luts($packages);

dump($luts);
