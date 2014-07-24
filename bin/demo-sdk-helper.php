<?php

include_once __DIR__ . '/../autoload_legacy.php';

use Tisd\Sdk\Helper as SdkHelper;


var_dump(SdkHelper::getPackageByUniqueId('69a5d3c60f'));
var_dump(SdkHelper::getPackageByPackageId('iccapture', array('locale' => 'de_DE')));
var_dump(SdkHelper::getPackageByProductCodeId('iccapture', array('locale' => 'de_DE')));

var_dump(SdkHelper::getPackages());
var_dump(SdkHelper::getPackages('downloads'));
var_dump(SdkHelper::getPackages('downloads', 'enduser'));
var_dump(SdkHelper::getPackages('downloads', 'enduser', 'iccapture', array('locale' => 'de_DE')));

SdkHelper::getCache()->purge();