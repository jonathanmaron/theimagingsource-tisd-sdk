<?php

namespace Tisd\Sdk;

use Tisd\Sdk\Defaults\Defaults;
use Tisd\Sdk\Cache\Cache;

class Sdk
{
    use ConsolidatedTrait;
    use ContextsTrait;
    use FilterTrait;
    use LocalesTrait;
    use MetaTrait;
    use PackagesTrait;
    use PackageTrait;

    protected $cache;

    protected $context;

    protected $hostname;

    protected $locale;

    protected $timeout;

    protected $version;

    public function test()
    {
        return 'hello world';
    }


    public function __construct($options = [])
    {
        $defaults = new Defaults();

        $optionKeys = [
            'context',
            'hostname',
            'locale',
            'timeout',
            'version',
        ];

        foreach ($optionKeys as $optionKey) {
            if (array_key_exists($optionKey, $options)) {
                $value = $options[$optionKey];
            } else {
                $getter = sprintf('get%s', ucfirst($optionKey));
                $value  = $defaults->$getter();
            }

            $setter = sprintf('set%s', ucfirst($optionKey));
            $this->$setter($value);
        }

        $cache = new Cache();

        $this->setCache($cache);
    }

    public function getCache()
    {
        return $this->cache;
    }

    public function setCache(Cache $cache)
    {
        $this->cache = $cache;

        return $this;
    }

    public function getContext()
    {
        return $this->context;
    }

    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    public function getHostname()
    {
        return $this->hostname;
    }

    public function setHostname($hostname)
    {
        $this->hostname = $hostname;

        return $this;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    public function getTimeout()
    {
        return $this->timeout;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
