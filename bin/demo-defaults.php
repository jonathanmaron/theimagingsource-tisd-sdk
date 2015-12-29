<?php

require __DIR__ . '/../vendor/autoload.php';


use Tisd\Defaults;
use Tisd\Sdk;

Defaults::setLocale('fr_FR');
Defaults::setContext(Defaults::CONTEXT_MACHINE_VISION);

$sdk = new Sdk();

$sdk->getPackages();    // fr_FR packages


$sdk = new Sdk(['locale' => 'de_DE']);

$sdk->getPackages();    // de_DE packages (constructor options overwrite default options)


var_dump($sdk->getLocale());
var_dump(Defaults::getLocale());

var_dump($sdk->getContext());
var_dump(Defaults::getContext());

var_dump($sdk->getHostname());
var_dump(Defaults::getHostname());

var_dump($sdk->getVersion());
var_dump(Defaults::getVersion());

var_dump($sdk->getTimeout());
var_dump(Defaults::getTimeout());
