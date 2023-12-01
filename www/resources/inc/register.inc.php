<?php

include_once 'connection.inc.php';
include_once __DIR__ . '/../lib/validator.lib.php';
include_once __DIR__ . '/../lib/user.lib.php';
include_once __DIR__ . '/../lib/encrypter.lib.php';

//POST FOR REGISTER -- under construction
//runs when the 'register new user' form is submitted
//sends form data to database, registering a new user
if(isset($_POST['submitRegister']) && is_string($_POST['passReg']) && is_string($_POST['emailReg']) && is_string($_POST['firstNameReg']) && is_string($_POST['lastNameReg']) && is_string($_POST['roleReg'])){
    $regValidator = new Validator;
    $firstName = ucfirst(strtolower($regValidator->cleanString($_POST['firstNameReg'])));
    $lastName = ucfirst(strtolower($regValidator->cleanString($_POST['lastNameReg'])));
    if ($regValidator->validateEmail($regValidator->cleanString($_POST['emailReg']))){
        $email = $regValidator->cleanString($_POST['emailReg']);
    } else {
        echo '<script>window.location.href = "index.php"; alert("Invalid e-mail")</script>';
    }
    if ($regValidator->validatePassword($regValidator->cleanString($_POST['passReg']))){
        $password = $regValidator->cleanString($_POST['passReg']);    
        $password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        echo '<script>window.location.href = "index.php"; alert("Invalid password")</script>';
    }
    if ($regValidator->cleanString($_POST['roleReg']) == "Assistant"){
        $isAssistant = true;
    } elseif ($regValidator->cleanString($_POST['roleReg']) == "Student"){
        $isAssistant = false;
    }
    if ($firstName != null && $lastName != null && $email != null && $password != null && $isAssistant != null){
        $newUser = new User();
        $newUser->createNewUser($firstName, $lastName, $email, $password, $isAssistant);
        $sqlInsertUser = "INSERT INTO users (FirstName, LastName, Email, IsAssistant, Password) VALUES (:firstName, :lastName, :email, :isAssistant, :password)";
        $query = $pdo->prepare($sqlInsertUser);
        $query->bindParam(":firstName", $newUser->firstName, PDO::PARAM_STR);
        $query->bindParam(":lastName", $newUser->lastName, PDO::PARAM_STR);
        $query->bindParam(":email", $newUser->email, PDO::PARAM_STR);
        $query->bindParam(":isAssistant", $newUser->isAssistant, PDO::PARAM_BOOL);
        $query->bindParam(":password", $newUser->password, PDO::PARAM_STR);

        try {
            $query->execute();
            header("Location:index.php");
        } catch(PDOException $exc){
            $errormsg = $exc;
        }
    }
} else {
    echo '<script>window.location.href = "index.php"; alert("All fields must be filled.")</script>';
}

?>