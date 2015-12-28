<?php

namespace TisdTest\Sdk\Exception;

use PHPUnit_Framework_TestCase;

use Tisd\Sdk\Exception\RuntimeException;

class RuntimeExceptionTest extends PHPUnit_Framework_TestCase
{

    public function testComingSoon()
    {
        $this->setExpectedException('RuntimeException', 'random-string', 100);

        throw new RuntimeException('random-string', 100);
    }
}
