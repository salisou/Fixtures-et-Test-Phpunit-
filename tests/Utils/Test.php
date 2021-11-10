<?php

namespace App\Tests\Utils;

use App\Utils\Calculator;
use CalculatorTest;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testadd()
    {
        $calculator = new Calculator();
        $result = $calculator->add(10, 32);

        $this->assertEquals(42, $result);
    }
}
