![The Imaging Source](http://s1.www.theimagingsource.com/application-0.0.0/img/corporate_id/tis_logo.png)

# The Imaging Source Downloads SDK

[![Coverage Status](https://coveralls.io/repos/jonathanmaron/theimagingsource-tisd/badge.svg?branch=master&service=github)](https://coveralls.io/github/jonathanmaron/theimagingsource-tisd?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jonathanmaron/theimagingsource-tisd/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jonathanmaron/theimagingsource-tisd/?branch=master)
[![Total Downloads](https://poser.pugx.org/theimagingsource/tisd/downloads)](https://packagist.org/packages/theimagingsource/tisd)
[![Latest Stable Version](https://poser.pugx.org/theimagingsource/tisd/v/stable)](https://packagist.org/packages/theimagingsource/tisd)

The Imaging Source produces a large number of [downloadable files](http://dl-gui.theimagingsource.com/) (drivers, end-user software, documentation, images etc.). These resources are published at [dl.theimagingsource.com](https://dl.theimagingsource.com/) and are available via a JSON-based API. In addition to encapsulating the functionality of the JSON-based API, this component library provides several helper objects to make access to The Imaging Source downloads as simple and quick as possible.


## Installation

Use [Composer](https://getcomposer.org/doc/00-intro.md#globally) to install the SDK:

```composer require theimagingsource/tisd ~3.0```

And then install the dependencies with:

```composer install```

## Sample Endpoints

### Return all supported locales

* https://dl.theimagingsource.com/api/2.5/packages/en_US.json

### Return all supported contexts

* https://dl.theimagingsource.com/api/2.5/contexts/en_US.json

### Return meta information and statistics

* https://dl.theimagingsource.com/api/2.5/meta/en_US.json

### Return all data (consolidated)

* https://dl.theimagingsource.com/api/2.5/consolidated/en_US.json

### Return all packages in "Downloads"

* https://dl.theimagingsource.com/api/2.5/packages/downloads/en_US.json

### Return all packages in "Downloads" -> "Drivers"

* https://dl.theimagingsource.com/api/2.5/packages/downloads/drivers/en_US.json

### Return package matching product code ID

* https://dl.theimagingsource.com/api/2.5/get-package-by-product-code-id/icwdmuvccamtis/en_US.json

### Return package matching package ID

* https://dl.theimagingsource.com/api/2.5/get-package-by-package-id/icwdmuvccamtis/en_US.json

### Return package matching UUID

* https://dl.theimagingsource.com/api/2.5/get-package-by-uuid/9fb079e7-e7c8-5b46-bf34-5d3a4b3eb19b.json


## Programming Samples

The SDK ships with comprehensive samples illustrating all functionality. Please take a look in the `/bin` directory.


## Unit Tests

The SDK ships with complete unit tests. Simply run `composer test` in the root directory.


## JSON Structure

```
root
  categories
    sections
      packages
        package
```

### Loop through the JSON structure in PHP

```php
<?php

use Tisd\Sdk;

$sdk = new Sdk();

$packages = $sdk->getPackages();

foreach ($packages['children'] as $categoryId => $categories) {
    foreach ($categories['children'] as $sectionId => $sections) {
        foreach ($sections['children'] as $packageId => $package) {
            // $latestPackageVersion = array_shift($package['versions']);
        }
    }
}

foreach ($packages['children'] as $categoryId => $categories) {
    foreach ($categories['children'] as $sectionId => $sections) {
        foreach ($sections['children'] as $packageId => $package) {
            // $latestPackageVersion = array_shift($package['versions']);
        }
        if (0 === count($packages['children'][$categoryId]['children'][$sectionId]['children'])) {
            unset($packages['children'][$categoryId]['children'][$sectionId]);
        }
    }
    if (0 === count($packages['children'][$categoryId]['children'])) {
        unset($packages['children'][$categoryId]);
    }
}

?>
```
