![The Imaging Source](http://www.theimagingsource.com/img/tis_logo.png)

# The Imaging Source Downloads SDK

The Imaging Source produces a large number of downloadable files (drivers, end-user software, documentation, images etc.). These resources are published at dl.theimagingsource.com and are available via a JSON-based API. This SDK is a reference implementation of the API in PHP 5.3+.


## Sample Endpoints

### Supported Locales

* http://dl.theimagingsource.com/api/2.0/locales.json

### All Packages in "Downloads"

* http://dl.theimagingsource.com/api/2.0/packages/downloads/en_US.json

### Specific Package Matching Unique ID

* http://dl.theimagingsource.com/api/2.0/get-package-by-unique-id/42429eb2dc15f9750c8537bbe578861b34197bca91fcff4612305a146a9b883e.json

### Specific Package Product Code ID

* http://dl.theimagingsource.com/api/2.0/get-package-by-product-code-id/icwdmdcamtis/de_DE.json


## Programming Samples

The SDK ships with comprehensive samples illustrating all functionality. Please take a look in the `/bin` directory at `php demo-sdk.php` and `php demo-sdk-helper.php`.


