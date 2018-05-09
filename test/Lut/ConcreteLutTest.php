<?php

namespace TisdTest\Sdk\Lut;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Exception\RuntimeException;

class ConcreteLutTest extends TestCase
{
    /**
     * @expectedException RuntimeException
     */
    public function testException()
    {
        $lut = new ConcreteLut();
    }
}
