<?php

require_once 'FactorialCalculator.php';
require_once 'calculator.php';

class CFC extends FactorialCalculator implements Calculator {
    public function calculate($num): int|string
    {
        // Check if the number is positive
        if ($this->validate($num)) {
            // Calculate and return the factorial
            $factorial = 1;
            for ($i = 1; $i <= $num; $i++) {
                $factorial *= $i;
            }
            return $factorial;
        } else {
            return "Invalid number. Number must be positive.";
        }
    }
}