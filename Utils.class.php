<?php


class Utils {
    
    public static function isValidEmail($email){
        $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        
        return false;
    }
    
    
}

?>