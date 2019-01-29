<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Validator;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Validator\ProductCode as Validator;

class ProductCodeTest extends TestCase
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
        $this->assertFalse($this->validator->isValid('IC INVALID'));

        $this->assertTrue($this->validator->isValid('IC WDM GIGE TIS'));
    }
}
