<?php

namespace App\Tests\Calculator;

use App\Service\Calculator;
use PHPUnit\Framework\TestCase;

class CalculusTest extends TestCase
{

    public function testIsSumCorrect()
    {
        $calc = new Calculator();
        $result = $calc->add(1, 2.5);
        $expected = 3.5;
        $this->assertSame($expected, $result);
    }

    /**
     * @dataProvider dynamicSubtractCalculatorProvider
     * @dataProvider dynamicAddCalculatorProvider
     * @dataProvider dynamicMultiplyCalculatorProvider
     * @param $n1
     * @param $n2
     * @param $expected
     */
    public function test_DynamicCalculator(Calculator $calculator, $methodName, $n1, $n2, $expected)
    {
        $result = $calculator->{$methodName}($n1, $n2);
        $this->assertSame($expected, $result);
    }

    /**
     * @dataProvider additionProvider
     * @param $n1
     * @param $n2
     * @param $expected
     */
    public function test_Is_addition_Correct($n1, $n2, $expected)
    {
        $calc = new Calculator();
        $result = $calc->add($n1, $n2);
        $this->assertSame($expected, $result);
    }

    /**
     * @dataProvider subtractionProvider
     * @param $n1
     * @param $n2
     * @param $expected
     */
    public function test_Is_Subtract_Correct($n1, $n2, $expected)
    {
        $calc = new Calculator();
        $result = $calc->subtract($n1, $n2);
        $this->assertSame($expected, $result);
    }


    /**
     * @dataProvider multiplyProvider
     * @param $n1
     * @param $n2
     * @param $expected
     */
    public function test_Is_Multiply_Correct($n1, $n2, $expected)
    {
        $calc = new Calculator();
        $result = $calc->multiply($n1, $n2);
        $this->assertSame($expected, $result);
    }

    /**
     * @dataProvider divideProvider
     * @param $n1
     * @param $n2
     * @param $expected
     */
    public function test_Is_Divide_Correct($n1, $n2, $expected)
    {
        $calc = new Calculator();
        $result = $calc->divide($n1, $n2);

        $this->assertSame($expected, $result);
    }


//addition
    public function additionProvider(): array
    {
        return [
            "addition1" => [10, 51, 61],
            "addition2" => [34, 16, 50]
        ];
    }

    //subtraction
    public function subtractionProvider(): array
    {
        return [
            "subtraction1" => [1, 1, 0],
            "subtraction2" => [-1, 1, -2],
            "subtraction3" => [5, 1, 4],
            "subtraction4" => [1, 0.25, 0.75]
        ];
    }

    //divide
    public function multiplyProvider(): array
    {
        return [
            "multiply1" => [50, 3, 150],
            "multiply2" => [100, 5, 500]
        ];
    }

    //subtraction
    public function divideProvider(): array
    {
        return [
            "divide1" => [2, 2, 1],
            "divide2" => [4, 5, 0.8]
        ];
    }


    //Calculator sum
    public function dynamicAddCalculatorProvider(): array
    {
        $calculator = new Calculator();
        $methodName = 'add';

        return [
            __FUNCTION__ . "1+1" => [$calculator, $methodName, 1, 1, 2],
            __FUNCTION__ . "2+2" => [$calculator, $methodName, 2, 2, 4],
            __FUNCTION__ . "3+3" => [$calculator, $methodName, 3, 3, 6],
        ];
    }

    //Calculator sum
    public function dynamicSubtractCalculatorProvider(): array
    {
        $calculator = new Calculator();
        $methodName = 'subtract';

        return [
            __FUNCTION__ . "1-1" => [$calculator, $methodName, 1, 1, 0],
            __FUNCTION__ . "2-2" => [$calculator, $methodName, 2, 1, 1],
            __FUNCTION__ . "3-3" => [$calculator, $methodName, 3, 1, 2],
        ];
    }

    //Calculator sum
    public function dynamicMultiplyCalculatorProvider(): array
    {
        $calculator = new Calculator();
        $methodName = 'multiply';

        return [
            __FUNCTION__ . "1*1" => [$calculator, $methodName, 1, 1, 1],
            __FUNCTION__ . "2*2" => [$calculator, $methodName, 2, 2, 4],
            __FUNCTION__ . "3*3" => [$calculator, $methodName, 3, 3, 9],
        ];
    }


}