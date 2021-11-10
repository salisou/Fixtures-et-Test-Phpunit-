<?php

use App\Calculator;
use PHPUnit\Framework\TestCase;


class calculatorTest extends \PHPUnit\Framework\TestCase 
{
    public function testadd()
    {
        $calculator = new App\Calculator;
        $result = $calculator->add(20,5);

        $this->assertEquals(25, $result);
    }

    public function testSubtract() 
    {
        $calculator = new App\Calculator;
        $result = $calculator->subtract(20,5);

        $this->assertEquals(15, $result);
    }

    public function testMultiplcat()
    {
        $calculator = new App\Calculator;
        $result = $calculator->multiply(10,5);

        $this->assertEquals(50, $result);
    }

    public function testDivide()
    {
        $calculator = new App\Calculator;
        $result = $calculator->divide(10,2);

        $this->assertEquals(5, $result);
    }
}