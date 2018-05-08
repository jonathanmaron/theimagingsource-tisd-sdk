<?php

namespace Tisd;

trait LocalesTrait
{
    abstract protected function getConsolidated();

    public function getLocales()
    {
        $consolidated = $this->getConsolidated();

        return $consolidated['locales'];
    }
}
