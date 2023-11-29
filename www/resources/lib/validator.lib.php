<?php 

class Validator{

    /*
    function for cleaning strings of hostile inputs
    returns cleaned string  */
    public function cleanString(string $str){
        $str = htmlspecialchars(strip_tags($str));
        return $str;
    }

    public function validateEmail(string $email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        } else {
            return false;
        }
    }

    public function validatePassword(string $pass){
        $validator = new Validator;
        $pass = $validator->cleanString($pass);
        if(preg_match("/\S{9,}/", $pass)) {
            $errors = array();
            // runs if input does not contain a capitalized letter from A to Z
            if (!preg_match("/[A-Z]/", $pass)){
                $errors[] = 1;
            }
            // runs if input does not contain at least 2 of a number between 0 and 9
            if (!preg_match("/[0-9{1,}]/", $pass)){
                $errors[] = 1;
            }
            // runs if input does not contain a special character
            if (!preg_match("/\W/", $pass)){
                $errors[] = 1;
            }

            if ($errors){
                // WRITE ERRORCODE
            } else {
                // runs if none of the password cases runs
                return $pass;
            }
        }
    }
}

?>