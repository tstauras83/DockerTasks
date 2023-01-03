<?php
namespace tstauras83;
class Input {
    public function getInput($number, $precision): array
    {
        // validate the input
        if (!is_numeric($number)) {
            // if the input is not a valid number, show an error message and ask for input again
            echo "Error: Invalid input. Please enter a valid number.\n";
            return $this->getInput($number, $precision);
        }

        // validate the precision
        if ($precision != 2 && $precision != 4) {
            // if the precision is not 2 or 4, show an error message and ask for input again
            echo "Error: Invalid precision. Please enter 2 or 4.\n";
            return $this->getInput($number, $precision);
        }

        return [$number, $precision];
    }
}