<?php

use App\Service\Calculator;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testdouble()
    {
        $this->assertEquals(\App\Math::double(2), 4);
    }

    public function testdoubleifZeero()
    {
        $this->assertEquals(\App\Math::double(0), 0);
    }

    
}