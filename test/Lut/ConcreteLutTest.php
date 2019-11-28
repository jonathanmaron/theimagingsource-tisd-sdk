<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Lut;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Exception\RuntimeException;

class ConcreteLutTest extends TestCase
{
    public function testException(): void
    {
        $this->expectException(RuntimeException::class);

        $lut = new ConcreteLut();
    }
}
