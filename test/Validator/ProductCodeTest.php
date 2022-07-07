<?php
declare(strict_types=1);

namespace TisdTest\Sdk\Validator;

use PHPUnit\Framework\TestCase;
use Tisd\Sdk\Validator\ProductCode as Validator;

class ProductCodeTest extends TestCase
{
    protected Validator $validator;


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
        self::assertFalse($this->validator->isValid('IC INVALID'));

        self::assertTrue($this->validator->isValid('IC WDM GIGE TIS'));
    }
}
