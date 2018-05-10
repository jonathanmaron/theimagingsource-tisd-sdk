<?php

namespace Tisd\Sdk;

trait MetaTrait
{
    abstract protected function getConsolidated();

    public function getMeta()
    {
        $consolidated = $this->getConsolidated();

        return $consolidated['meta'] ?? [];
    }

    public function getCategoryCount()
    {
        $meta = $this->getMeta();

        return (int) $meta['category']['count'] ?? 0;
    }

    public function getSectionCount()
    {
        $meta = $this->getMeta();

        return (int) $meta['section']['count'] ?? 0;
    }

    public function getPackageCount()
    {
        $meta = $this->getMeta();

        return (int) $meta['package']['count'] ?? 0;
    }

    public function getBuildTime($type = 'timestamp')
    {
        $meta = $this->getMeta();

        return $meta['build']['time'][$type] ?? null;
    }
}
