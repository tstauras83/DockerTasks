<?php


trait PositiveNumberChecker {
    public function check($num): bool
    {
        return $num > 0;
    }
}
