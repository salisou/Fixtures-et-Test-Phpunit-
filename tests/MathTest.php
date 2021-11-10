<?php

use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testdouble()
    {
        $this->assertEquals(4, \App\Math::double(2));
    }

    public function testdoubleifZeero()
    {
        $this->assertEquals(0, \App\Math::double(0));
    }
}