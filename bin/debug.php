<?php

require __DIR__ . '/../vendor/autoload.php';

use Tisd\Defaults\Defaults;
use Tisd\Sdk;

$sdk = new Sdk(['locale'   => 'de_DE',
                'hostname' => Defaults::HOSTNAME_DEVELOPMENT,
                //'context'  => Defaults::CONTEXT_ASTRONOMY,
               ]);
/*
//$sdk->getCache()->purge();

$categories = $sdk->getPackages('downloads', 'drivers');

foreach ($categories['children'] as $package) {

    dump($package['contexts']);

}
*/

/*
$packages = $sdk->getPackagesByProductCodes(['IC WDM DCAM TIS', 'IC WDM GIGE TIS', 'IC WDM 878 TIS']);

dump($packages);
*/

//$packages = $sdk->getPackagesByProductCodeSearch('FS/');

$packaged = $sdk->getPackageByProductCode('IC WDM DCAM TIS');

dump($packaged);
