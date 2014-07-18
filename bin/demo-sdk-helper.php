<?php

include_once __DIR__ . '/init_autoloader.php';

use Tisd\Sdk\Helper as SdkHelper;


var_dump(SdkHelper::getPackageByUniqueId('9088530fa7e9dcf03ade2118acc662ddab4e614d8069e5979e99dd2be47e6517', array('locale' => 'de_DE')));
var_dump(SdkHelper::getPackageByPackageId('iccapture', array('locale' => 'de_DE')));
var_dump(SdkHelper::getPackageByProductCodeId('iccapture', array('locale' => 'de_DE')));

var_dump(SdkHelper::getPackages());
var_dump(SdkHelper::getPackages('downloads'));
var_dump(SdkHelper::getPackages('downloads', 'enduser'));
var_dump(SdkHelper::getPackages('downloads', 'enduser', 'iccapture', array('locale' => 'de_DE')));

SdkHelper::getCache()->purge();