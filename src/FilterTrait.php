<?php

namespace Tisd\Sdk;

/**
 * Trait FilterTrait
 *
 * @package Tisd\Sdk
 */
trait FilterTrait
{
    /**
     * Filter the packages by key
     *
     * @param array  $packages
     * @param string $key
     * @param string $value
     * @param bool   $fuzzy
     *
     * @return mixed
     */
    protected function filter($packages, $key, $value, $fuzzy = false)
    {
        // this approach is faster than recursively.

        foreach ($packages['children'] as $categoryId => $categories) {

            foreach ($categories['children'] as $sectionId => $sections) {

                foreach ($sections['children'] as $packageId => $package) {

                    if (!isset($package[$key])) {
                        continue;
                    }

                    // Fuzzy match: Package value is a string; passed value is a string
                    // Package value must start with passed value

                    if ($fuzzy) {
                        $string = substr($package[$key], 0, strlen($value));
                        if (0 === strcasecmp($string, $value)) {
                            continue;
                        }
                    }

                    // Passed value is an array; package value is a string

                    elseif (is_array($value)) {
                        if (in_array($package[$key], $value)) {
                            continue;
                        }
                    }

                    // Package value is an array; passed value is a string

                    elseif (is_array($package[$key])) {
                        if (in_array($value, $package[$key])) {
                            continue;
                        }
                    }

                    // Package value is a string; passed value is a string

                    else {
                        if ($value == $package[$key]) {
                            continue;
                        }
                    }

                    unset($packages['children'][$categoryId]['children'][$sectionId]['children'][$packageId]);
                }

                if (0 === count($packages['children'][$categoryId]['children'][$sectionId]['children'])) {
                    unset($packages['children'][$categoryId]['children'][$sectionId]);
                }
            }

            if (0 === count($packages['children'][$categoryId]['children'])) {
                unset($packages['children'][$categoryId]);
            }
        }

        return $packages;
    }
}
