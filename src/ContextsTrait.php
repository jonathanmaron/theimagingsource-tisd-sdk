<?php

namespace Tisd;

trait ContextsTrait
{
    abstract protected function getConsolidated();

    public function getContexts()
    {
        $consolidated = $this->getConsolidated();

        return $consolidated['contexts'];
    }
}
