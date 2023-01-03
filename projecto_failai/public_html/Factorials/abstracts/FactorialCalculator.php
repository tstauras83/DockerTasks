<?php

include 'PositiveNumberChecker.php';
abstract class FactorialCalculator {
    use PositiveNumberChecker;

    abstract public function calculate($num);

    public function validate($num): bool
    {
        return $this->check($num);
    }
}