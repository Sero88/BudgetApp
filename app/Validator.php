<?php

namespace App;

class Validator
{
    public static function validateNumber($number){
        $intYearValue = intval($number);

        if(!$intYearValue){
            return false;
        } else{
            return $intYearValue;
        }
    }
}
