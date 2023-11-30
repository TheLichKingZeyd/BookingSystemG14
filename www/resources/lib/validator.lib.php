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
            echo '<script>window.location.href = "index.php"; alert("Your e-mail is invalid.")</script>';
            return false;
        }
    }

    public function validatePassword(string $pass){
        if(preg_match("/\S{9,}/", $pass)) {
            $errors = array();
            $errormsg = "Your password must contain ";
            if (!preg_match("/[A-Z]/", $pass)){
                // runs if input does not contain a capitalized letter from A to Z
                $errors[] = 1;
                $errormsg .= "a capital letter";
            }
            if (!preg_match("/[0-9{1,}]/", $pass)){
                // runs if input does not contain at least 2 of a number between 0 and 9
                if ($errors){
                    $errormsg .= ", a number";
                } else {
                    $errormsg .= "a number";
                }
                $errors[] = 1;
            }
            if (!preg_match("/\W/", $pass)){
                // runs if input does not contain a special character
                if ($errors){
                    $errormsg .= ", a special character.";
                } else {
                    $errormsg .= "a special character.";
                }
                $errors[] = 1;
            }
            if ($errors){
                // runs if any errors are found
                echo '<script>window.location.href = "index.php"; alert(' . $errormsg . ')</script>';
                return false;
            } else {
                // runs if no errors are found
                return true;
            }
        }
    }
}

?>