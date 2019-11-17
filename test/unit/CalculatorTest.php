<?php
include '../../src/Calculator.php'; 
use PHPUnit\Framework\TestCase;
use Tools\Calculator;

class CalculatorTest extends TestCase
{
    /**
     * @dataProvider calculateDataProvider
     */
    public function testCalculate($numbers, $operator, $expected) 
    {
        $calculator = new Calculator;
        $calculation = $calculator->calculate($numbers, $operator);
        $this->assertEquals($expected, $calculation);
    }

    public function calculateDataProvider()
    {
        return [
            'Adding' => [[1,2], '+', 3],
            'Subtracting' => [[3,3], '-', 0],
            'Divide' => [[10, 2], '/', 5],
            'Multiply' => [[3,10], '*', 30],
            'Null number' => [[null,4], '+', 0],
            'Incorrect Operator' => [[1,4], 'x', 0],
            'Operator not a string' => [[3,3], 5, 0],
            'String instead of numbers provided' => [['a, b, c'], '+', 0],
            'Not an array of numbers given' => [234, '+', 0]
        ];
    }
}