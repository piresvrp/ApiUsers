<?php 

namespace source\Models;

final class Validations{

    public static function validationString(string $string){
        return strlen($string)>= 3 && !is_numeric($string);
    }

    public static function validationInterger(string $interger){
        return filter_var($interger, FILTER_VALIDATE_INT);
    }

    public static function validationEmail(string $Email){
        return filter_var($Email, FILTER_VALIDATE_EMAIL);
    }
}


?>