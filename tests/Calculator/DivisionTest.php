<?php

namespace App\Tests\Calculator;

use App\Service\Calculator;
use PHPUnit\Framework\TestCase;

class DivisionTest extends TestCase
{
    public function test_division_given_operands()
    {

        $this->markTestSkipped();

        $division = new \App\Service\Calculator();

        $division->divide([100, 2]);

        $this->assertEquals(50, $division);

        self::assertEquals();
    }
}