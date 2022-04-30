<?php

use app\models\Factorial;

class FactorialTest extends PHPUnit\Framework\TestCase
{
    public function testFactorial()
    {
        $my = new Factorial();
        $this->assertEquals(6, $my->factorial(3));
    }
}