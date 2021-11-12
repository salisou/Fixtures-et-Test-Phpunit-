<?php

namespace App\Tests;


use App\Utils\Calculator;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{

   //public function testTestArWorking()
   //{
   //    $calculator = new \App\Service\Calculator();

   //    $this->assertSame(2, 1+1);

   //    $this->assertSame($calculator->add(1,1), 2);
   //}

    /**
     * @dataProvider multiplicityProvider
     * @param $nb1
     * @param $nb2
     * @param $equal
     */
    public function multiplicity($nb1, $nb2, $equal)
    {
        $this->markTestSkipped();
        $this->assertSame($equal, $nb1 * $nb2);
    }

    public function multiplicityProvider(): array
    {
        return [
            [10, 5, 2],
            [50, 5, 10],
            [250, 10, 20]
        ];
    }

}