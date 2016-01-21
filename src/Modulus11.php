<?php

namespace Komakino\Modulus11;

class Modulus11
{
    static $factors = [2,3,4,5,6,7];

    private static function toInt($number) {
        return preg_replace('/[^\wX]/','',strtoupper($number));
    }

    private static function getChecksum($number, $factors = null)
    {
        $factors  = $factors ?: static::$factors;
        $number   = static::toInt($number);
        $sequence = array_reverse(str_split($number));
        $sum      = 0;
        for($i=0; $i<count($sequence); $i++){
            $factor = $factors[$i%count($factors)];
            $sum    += ($sequence[$i] * $factor);
        }

        $calculus = 11 - $sum % 11;

        switch($calculus){
            case 10: return 'X';
            default: return $calculus;
        }
    }

    public static function validate($number, $factors = null)
    {
        $number = static::toInt($number);
        list($partial_number,$checkdigit) = str_split($number, strlen($number)-1);
        return static::getChecksum($partial_number,$factors) == $checkdigit;
    }

    public static function calculate($partial_number, $factors = null)
    {
        return static::getChecksum($partial_number,$factors);
    }

    public static function appendCheckDigit($partial_number, $factors = null){
        return $partial_number . static::getChecksum($partial_number,$factors);
    }
}
