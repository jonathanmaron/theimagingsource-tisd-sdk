<?php

namespace TisdTest\Sdk\Validator;

use PHPUnit_Framework_TestCase;

use Tisd\Sdk\Validator\PackageId as TisdSdkValidatorPackageId;

class PackageIdTest extends PHPUnit_Framework_TestCase
{
    protected $validator;

    protected function setUp()
    {
        $this->validator = new TisdSdkValidatorPackageId();
    }

    protected function tearDown()
    {
        unset($this->validator);
    }

    public function testComingSoon()
    {
        $this->markTestSkipped();
    }
}
