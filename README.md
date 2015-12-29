![The Imaging Source](http://www.theimagingsource.com/img/tis_logo.png)

# The Imaging Source Downloads SDK

[![Build Status](https://travis-ci.org/jonathanmaron/theimagingsource-tisd.svg)](https://travis-ci.org/jonathanmaron/theimagingsource-tisd)
[![Coverage Status](https://coveralls.io/repos/jonathanmaron/theimagingsource-tisd/badge.svg?branch=master&service=github)](https://coveralls.io/github/jonathanmaron/theimagingsource-tisd?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jonathanmaron/theimagingsource-tisd/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jonathanmaron/theimagingsource-tisd/?branch=master)
[![Total Downloads](https://poser.pugx.org/theimagingsource/tisd/downloads)](https://packagist.org/packages/theimagingsource/tisd)
[![Latest Stable Version](https://poser.pugx.org/theimagingsource/tisd/v/stable)](https://packagist.org/packages/theimagingsource/tisd)

The Imaging Source produces a large number of [downloadable files](http://dl-gui.theimagingsource.com/) (drivers, end-user software, documentation, images etc.). These resources are published at [dl.theimagingsource.com](http://dl.theimagingsource.com/) and are available via a JSON-based API. In addition to encapsulating the functionality of the JSON-based API, this component library provides several helper objects to make access to The Imaging Source downloads as simple and quick as possible.


## Installation

[Composer](https://getcomposer.org/doc/00-intro.md#globally) is the only supported method of installation.

```composer require theimagingsource/tisd ~2.5```

And then execute:

```composer install```

or (for an optimized autoload map):
 
```composer install --optimize-autoloader```


## Sample Endpoints

### Return all supported locales

* http://dl.theimagingsource.com/api/2.0/locales.json

### Return all supported contexts

* http://dl.theimagingsource.com/api/2.0/contexts/en_US.json

### Return meta information and statistics

* http://dl.theimagingsource.com/api/2.0/meta/en_US.json

### Return all packages in "Downloads"

* http://dl.theimagingsource.com/api/2.0/packages/downloads/en_US.json

### Return package matching product code ID

* http://dl.theimagingsource.com/api/2.0/get-package-by-product-code-id/icwdmuvccamtis/en_US.json

### Return package matching package ID

* http://dl.theimagingsource.com/api/2.0/get-package-by-package-id/icwdmuvccamtis/en_US.json

### Return package matching unique ID

* http://dl.theimagingsource.com/api/2.0/get-package-by-unique-id/d97fcf0a20.json


## Programming Samples

The SDK ships with comprehensive samples illustrating all functionality. Please take a look in the `/bin` directory at `php demo-sdk.php` and `php demo-sdk-helper.php`.


## Unit Tests

The SDK ships with complete unit tests. Simply run `phpunit` in the root directory.


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