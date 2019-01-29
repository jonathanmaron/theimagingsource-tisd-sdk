<?php
declare(strict_types=1);

/**
 * The Imaging Source Download System PHP Wrapper
 *
 * PHP wrapper for The Imaging Source Download System Web API. Authored and supported by The Imaging Source Europe GmbH.
 *
 * @link      http://dl-gui.theimagingsource.com to learn more about The Imaging Source Download System
 * @link      https://github.com/jonathanmaron/theimagingsource-tisd-sdk for the canonical source repository
 * @license   https://github.com/jonathanmaron/theimagingsource-tisd-sdk/blob/master/LICENSE.md
 * @copyright © 2019 The Imaging Source Europe GmbH
 */

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
     * @param array|string $value
     * @param bool   $fuzzy
     *
     * @return mixed
     */
    protected function filter(array $packages, string $key, $value, bool $fuzzy = false): array
    {
        // this approach is faster than recursively.

        foreach ($packages['children'] as $categoryId => $categories) {

            foreach ($categories['children'] as $sectionId => $sections) {

                foreach ($sections['children'] as $packageId => $package) {

                    if (!isset($package[$key])) {
                        continue;
                    }

                    if ($fuzzy) {
                        // Fuzzy match: Package value is a string; passed value is a string
                        // Package value must start with passed value
                        $string = substr($package[$key], 0, strlen($value));
                        if (0 === strcasecmp($string, $value)) {
                            continue;
                        }
                    } elseif (is_array($value)) {
                        // Passed value is an array; package value is a string
                        if (in_array($package[$key], $value)) {
                            continue;
                        }
                    } elseif (is_array($package[$key])) {
                        // Package value is an array; passed value is a string
                        if (in_array($value, $package[$key])) {
                            continue;
                        }
                    } else {
                        // Package value is a string; passed value is a string
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
