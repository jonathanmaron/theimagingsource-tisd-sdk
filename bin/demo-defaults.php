<?php

include_once __DIR__ . '/common.php';


use Tisd\Defaults as TisdDefaults;
use Tisd\Sdk      as TisdSdk;


TisdDefaults::setLocale('fr_FR');
TisdDefaults::setContext(TisdDefaults::CONTEXT_MACHINE_VISION);

$sdk = new TisdSdk();

$sdk->getPackages();    // fr_FR packages


$sdk = new TisdSdk(array('locale'=>'de_DE'));

$sdk->getPackages();    // de_DE packages (constructor options overwrite default options)


var_dump($sdk->getLocale());
var_dump(TisdDefaults::getLocale());

var_dump($sdk->getContext());
var_dump(TisdDefaults::getContext());

var_dump($sdk->getHostname());
var_dump(TisdDefaults::getHostname());

var_dump($sdk->getVersion());
var_dump(TisdDefaults::getVersion());

var_dump($sdk->getTimeout());
var_dump(TisdDefaults::getTimeout());

