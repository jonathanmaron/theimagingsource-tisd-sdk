<?php

include_once __DIR__ . '/init_autoloader.php';

use Tisd\Sdk\Helper as SdkHelper;


var_dump(SdkHelper::getPackageByUniqueId('d8f0e8d38af87c120ee5ba34401a4712ae21d7bee3e9bbb70cd9fd301d72b840'));
var_dump(SdkHelper::getPackageByPackageId('iccapture', array('locale' => 'de_DE')));
var_dump(SdkHelper::getPackageByProductCodeId('iccapture', array('locale' => 'de_DE')));

var_dump(SdkHelper::getPackages());
var_dump(SdkHelper::getPackages('downloads'));
var_dump(SdkHelper::getPackages('downloads', 'enduser'));
var_dump(SdkHelper::getPackages('downloads', 'enduser', 'iccapture', array('locale' => 'de_DE')));

SdkHelper::getCache()->purge();