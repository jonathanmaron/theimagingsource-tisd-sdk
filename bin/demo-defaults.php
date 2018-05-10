<?php

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Sdk\Defaults\Defaults;
use Tisd\Sdk\Sdk;

$sdk = new Sdk([
    'locale'  => 'zh_CN',
    'context' => Defaults::CONTEXT_MACHINE_VISION,
    'ttl'     => 10,
    'timeout' => 50,
]);

dump($sdk->getPackages());

$sdk = new Sdk([
    'locale' => 'de_DE'
]);

dump($sdk->getPackages());
dump($sdk->getLocale());
dump($sdk->getContext());
dump($sdk->getHostname());
dump($sdk->getVersion());
dump($sdk->getTimeout());

$sdk->getCache()->purge();
