<?php

namespace Tisd;

use Tisd\Defaults;

trait ConsolidatedTrait
{
    private $consolidated;

    protected function getConsolidated()
    {
        if (null === $this->consolidated) {

            $cache   = $this->getCache();
            $cacheId = __METHOD__;

            if ($cache->getTtl() > 0) {
                $cacheId      = $cache->getId($cacheId);
                $consolidated = $cache->read($cacheId);
                if (!$consolidated) {
                    $consolidated = $this->downloadConsolidated();
                    $cache->write($cacheId, $consolidated);
                }
            } else {
                $consolidated = $this->downloadConsolidated();
            }

            //@todo: Filter by context here

            $this->setConsolidated($consolidated);
        }

        return $this->consolidated;
    }

    protected function setConsolidated($consolidated)
    {
        $this->consolidated = $consolidated;

        return $this;
    }

    private function downloadConsolidated()
    {
        $format = 'https://%s/api/%s/consolidated/%s.json';
        $uri    = sprintf($format, $this->getHostname(), $this->getVersion(), $this->getLocale());

        $options = [
            'http' => [
                'timeout' => $this->getTimeout(),
            ],
        ];

        if ($this->getHostname() === Defaults::HOSTNAME_DEVELOPMENT) {
            $options['ssl'] = [
                'verify_peer'      => false,
                'verify_peer_name' => false,
            ];
        }

        $context = stream_context_create($options);

        $json = file_get_contents($uri, false, $context);
        $ret  = json_decode($json, true);

        return $ret;
    }
}
