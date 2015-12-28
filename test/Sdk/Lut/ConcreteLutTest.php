<?php

namespace TisdTest\Sdk\Lut;

use PHPUnit_Framework_TestCase;

use Tisd\Sdk\Exception\RuntimeException as RuntimeException;

class ConcreteLutTest extends PHPUnit_Framework_TestCase
{

    public function testException()
    {
        $this->setExpectedException('RuntimeException');

        $lut = new ConcreteLut();
    }

}
