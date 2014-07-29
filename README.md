![The Imaging Source](http://www.theimagingsource.com/img/tis_logo.png)

# The Imaging Source Downloads SDK

The Imaging Source produces a large number of downloadable files (drivers, end-user software, documentation, images etc.). These resources are published at dl.theimagingsource.com and are available via a JSON-based API. This SDK is a reference implementation of the API in PHP 5.3+.


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

* http://dl.theimagingsource.com/api/2.0/get-package-by-unique-id/f5e37622a7.json


## Programming Samples

The SDK ships with comprehensive samples illustrating all functionality. Please take a look in the `/bin` directory at `php demo-sdk.php` and `php demo-sdk-helper.php`.


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