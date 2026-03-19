<?php

namespace App\Helpers;

class NumberHelper
{
    public static function convertToWords($number)
    {
        $words = array(
            0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five',
            6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine', 10 => 'ten',
            11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen', 20 => 'twenty',
            30 => 'thirty', 40 => 'forty', 50 => 'fifty', 60 => 'sixty', 70 => 'seventy',
            80 => 'eighty', 90 => 'ninety', 100 => 'hundred', 1000 => 'thousand'
        );
        
        if ($number == 0) return 'zero';
        
        $result = '';
        if ($number >= 1000) {
            $thousands = intval($number / 1000);
            $result .= $words[$thousands] . ' thousand ';
            $number %= 1000;
        }
        if ($number >= 100) {
            $hundreds = intval($number / 100);
            $result .= $words[$hundreds] . ' hundred ';
            $number %= 100;
        }
        if ($number > 0) {
            if ($number <= 20) {
                $result .= $words[$number];
            } else {
                $tens = intval($number / 10) * 10;
                $ones = $number % 10;
                $result .= $words[$tens];
                if ($ones > 0) {
                    $result .= ' ' . $words[$ones];
                }
            }
        }
        
        return ucfirst(trim($result));
    }
}
