<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Validator;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Validator\ProductCodeId as Validator;

class ProductCodeIdTest extends TestCase
{
    protected $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    protected function tearDown(): void
    {
        unset($this->validator);
    }

    public function testIsValid(): void
    {
        $this->assertFalse($this->validator->isValid('invalid'));

        $this->assertTrue($this->validator->isValid('flhc12142m'));
    }
}
