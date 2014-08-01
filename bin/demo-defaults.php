<?php

include_once __DIR__ . '/common.php';


use Tisd\Sdk as TisdSdk;
use Tisd\Defaults as TisdDefaults;



TisdDefaults::setLocale('fr_FR');
TisdDefaults::setContext(TisdDefaults::CONTEXT_MACHINE_VISION);




$sdk = new TisdSdk(array('locale'=>'de_DE'));

$packages = $sdk->getPackages();

//var_dump($packages);


var_dump(TisdDefaults::getLocale());
var_dump(TisdDefaults::getContext());
var_dump(TisdDefaults::getHostname());
var_dump(TisdDefaults::getVersion());
var_dump(TisdDefaults::getTimeout());

