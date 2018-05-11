<?php

namespace Tisd\Sdk;

/**
 * Trait LocalesTrait
 *
 * @package Tisd\Sdk
 */
trait LocalesTrait
{
    /**
     * Get the array of consolidated data
     *
     * @return array
     */
    abstract protected function getConsolidated();

    /**
     * Get the array of locales
     *
     * @return array
     */
    public function getLocales()
    {
        $consolidated = $this->getConsolidated();

        return $consolidated['locales'] ?? [];
    }
}
