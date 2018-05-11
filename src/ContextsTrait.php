<?php

namespace Tisd\Sdk;

/**
 * Trait ContextsTrait
 *
 * @package Tisd\Sdk
 */
trait ContextsTrait
{
    /**
     * Get the array of consolidated data
     *
     * @return array
     */
    abstract protected function getConsolidated();

    /**
     * Get the array of contexts
     *
     * @return array
     */
    public function getContexts()
    {
        $consolidated = $this->getConsolidated();

        return $consolidated['contexts'] ?? [];
    }
}
