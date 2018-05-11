<?php

namespace Tisd\Sdk;

use Tisd\Sdk\Exception\InvalidArgumentException;

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
        $types = [
            'timestamp',
            'rtf_2822',
            'iso_8601',
        ];

        if (!in_array($type, $types)) {
            $format  = '"type" must be one of %s';
            $message = sprintf($format, implode(', ', $types));
            throw new InvalidArgumentException($message);
        }

        $meta = $this->getMeta();

        return $meta['build']['time'][$type] ?? null;
    }
}
