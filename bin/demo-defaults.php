<?php

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Defaults;
use Tisd\Sdk;

Defaults::setLocale('zh_CN');
Defaults::setContext(Defaults::CONTEXT_MACHINE_VISION);

$sdk = new Sdk();

// zh_CN packages
$sdk->getPackages();

$sdk = new Sdk(['locale' => 'de_DE']);

// de_DE packages (constructor options overwrite default options)
$sdk->getPackages();

dump($sdk->getLocale());
dump(Defaults::getLocale());

dump($sdk->getContext());
dump(Defaults::getContext());

dump($sdk->getHostname());
dump(Defaults::getHostname());

dump($sdk->getVersion());
dump(Defaults::getVersion());

dump($sdk->getTimeout());
dump(Defaults::getTimeout());

$sdk->getCache()->purge();
