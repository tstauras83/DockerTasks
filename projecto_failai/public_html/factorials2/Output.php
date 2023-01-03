<?php
namespace tstauras83;
class Output {
    public function display($result, $precision, $number): void
    {
        echo "The square root of $number is: " . number_format($result, $precision) . "\n";
    }
}