<?php

namespace tstauras83;

use tstauras83\Exceptions\ValidatorException;

class Validator
{
    public static function required($value): void
    {
        if (empty($value)) {
            throw new ValidatorException('Neuzpildyti visi laukai');
        }
    }

    public static function numeric($value): void
    {
        if (!is_numeric($value)) {
            throw new ValidatorException('Laukas turi buti skaicius');
        }
    }

    public static function personalcode(int $code)
    {
        if(strlen($code) != 11
            || $code == 0
            || !in_array(substr($code, 0, 1), [3,4,5,6])
        ) {
            throw new ValidatorException('Netinkamas asmens kodas');
        }
    }

    public static function min(int $kuris, int $min)
    {
        if($kuris < $min) {
            throw new ValidatorException('Per mazas skaitmuo. Reikalaujamas dydis min. ' . $min);
        }
    }

    public static function phone($value){
        if (str_starts_with($value, "+")) {
            if (strlen($value) > 12 || strlen($value) < 12) {
                throw new ValidatorException('does not start with + or is too long');
            }
        } elseif (str_starts_with($value, "00")) {
            if (strlen($value) > 10 || strlen($value) < 10) {
                throw new ValidatorException('does not start with 00 or is too long');
            }
        } else {
            throw new ValidatorException('bad phone number');
        }
    }

    public static function email($value){
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new ValidatorException('invalid email format');
        }
    }

}