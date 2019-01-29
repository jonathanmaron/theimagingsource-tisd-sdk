<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Lut;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Exception\RuntimeException;

class ConcreteLutTest extends TestCase
{
    /**
     * @expectedException RuntimeException
     */
    public function testException(): void
    {
        $lut = new ConcreteLut();
    }
}
