<?php

namespace tstauras83;

use tstauras83\Input;
use tstauras83\Calculator2;
use tstauras83\Output;

class Main1 {
    public function run($number, $precision): void
    {
        // create an instance of the Input class
        $input = new Input();

        // use the getInput method of the Input instance to validate the input
        [$number, $precision] = $input->getInput($number, $precision);

        // create an instance of the Calculator2 class
        $calculator = new Calculator2();

        // calculate the square root of the number
        $result = $calculator->calculate($number);

        // create an instance of the Output class
        $output = new Output();
        echo "Calculating the square root of $number with $precision decimal places...\n";

        // use the display method of the Output instance to output the result of the calculation
        $output->display($result, $precision, $number);
    }
}

