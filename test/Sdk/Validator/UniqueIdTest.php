<?php

namespace TisdTest\Sdk\Validator;

use PHPUnit_Framework_TestCase;

use Tisd\Sdk\Validator\UniqueId as TisdSdkValidatorUniqueId;

class UniqueIdTest extends PHPUnit_Framework_TestCase
{
    protected $validator;

    protected function setUp()
    {
        $this->validator = new TisdSdkValidatorUniqueId();
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