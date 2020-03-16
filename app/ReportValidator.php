<?php


namespace App;


class ReportValidator
{
    public static function validateYear($year){
        $intYearValue = intval($year);

        if(!$intYearValue){
            $error =  json_encode(['error' => 'invalid year']);
            abort('400', $error);
        } else{
            return $intYearValue;
        }
    }
}
