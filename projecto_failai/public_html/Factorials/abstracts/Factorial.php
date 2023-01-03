<?php

// Function to calculate the factorial of a number
function calculateFactorial($num) {
    $factorial = 1;
    for ($i = 1; $i <= $num; $i++) {
        $factorial *= $i;
    }
    return $factorial;
}

// Get the number from the user
$num = readline("Enter a number: ");

// Calculate and display the factorial
$factorial = calculateFactorial($num);
echo "The factorial of $num is $factorial\n";