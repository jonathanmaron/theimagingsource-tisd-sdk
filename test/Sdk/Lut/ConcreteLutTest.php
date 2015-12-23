<?php

namespace TisdTest\Sdk\Lut;

use PHPUnit_Framework_TestCase;

use Tisd\Sdk\Exception\RuntimeException as RuntimeException;

class ConcreteLutTest extends PHPUnit_Framework_TestCase
{

    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    /**
     * @expectedException RuntimeException
     */
    public function testException()
    {
        $lut = new ConcreteLut();
    }


}
