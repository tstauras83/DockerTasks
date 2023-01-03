<?php

// Include the ConcreteFactorialCalculator file
require_once 'abstracts/ConcreteFactorialCalculator.php';

class Main {
    public function run($num): int|string
    {
        $calculator = new CFC();
        $result = $calculator->calculate($num);

        return "Result: $result\n";
    }
}
