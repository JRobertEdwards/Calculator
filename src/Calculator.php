<?php
namespace Tools;

Class Calculator
{
    private $sumTotal;
    const ADD = '+';
    const SUBTRACT = '-';
    const DIVIDE = '/';
    const MULTIPLY = '*';
    const OPERATORS_ARRAY = [self::ADD, self::SUBTRACT, self::DIVIDE, self::MULTIPLY];

    const ERROR_RETURN = 0;
    const ERROR_NULL_NUMBER = 'Number provided is null';
    const ERROR_NUMBERS_NOT_INTEGERS = 'Numbers given are not integers';
    const ERROR_NUMBERS_NOT_ARRAY = 'The numbers provided are not in an array';
    const ERROR_OPERATOR_NOT_STRING = 'Operator provided is not a string';
    const ERROR_OPERATOR_NOT_RECOGNISED = 'The operator provided does not match any in use. ' .
                                           'Operator must be one of: +, -, /, or *';
    

    /**
     * Iterate over an array of numbers and return the final calculations of all values.
     *
     * @param int $numbers
     * @param string $operator
     * @return int $this->sumTotal
     */
    public function calculate($numbers, $operator) 
    {
        if(!is_array($numbers)) {
            error_log(self::ERROR_NUMBERS_NOT_ARRAY, 4);
            return self::ERROR_RETURN;
        }
        foreach($numbers as $number) {
            if(is_numeric($number) && in_array($operator, self::OPERATORS_ARRAY)) {
                if($this->setSumTotal($number)) {
                    continue;
                }
                //initialise sum value from first number
                $this->analyseOperation($number, $operator);
            } else {
                $this->logError($number, $operator);
                return self::ERROR_RETURN;
            }
        }
        return $this->sumTotal;
    }

    /**
     * Check what string operator has been used
     *
     * @param int $number
     * @param string $operation
     * @return void
     */
    private function analyseOperation($number, $operation)
    {
        switch($operation) {
            case self::ADD:
                $this->add($number);
                break;
            case self::SUBTRACT:
                $this->subtract($number);
                break;
            case self::MULTIPLY:
                $this->multiply($number);
                break;
            case self::DIVIDE:
                $this->divide($number);
                break;
        }
    }

    private function add($number)
    {
        return $this->sumTotal += $number;
    }

    private function subtract($number) 
    {
        return $this->sumTotal -= $number;
    }

    private function multiply($number)
    {
        return $this->sumTotal *= $number;
    }

    private function divide($number)
    {
        return $this->sumTotal /= $number;
    }

    /**
     * Sets the first number as the base value for the calculation
     *
     * @param int $number
     * @return boolean
     */
    private function setSumTotal($number) 
    {
        if(!isset($this->sumTotal)) {
            $this->sumTotal = $number;
            return true;
        }
        return false;
    }

    private function logError($number, $operator)
    {

        if($number == null) {
            return error_log(self::ERROR_NULL_NUMBER, 4);
        }

        if(!is_numeric($number)) {
            return error_log(self::ERROR_NUMBERS_NOT_INTEGERS, 4);
        }

        if(!is_string($operator)) {
            return error_log(self::ERROR_OPERATOR_NOT_STRING, 4);
        }

        if(!in_array($operator, self::OPERATORS_ARRAY)) {
            return error_log(self::ERROR_OPERATOR_NOT_RECOGNISED, 4);
        }
    }
}

?>