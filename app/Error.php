<?php

namespace App;

class Error
{
    public static function showError($code, $message){
        $error =  json_encode(['error' => $message]);
        abort('400', $error);
    }
}
