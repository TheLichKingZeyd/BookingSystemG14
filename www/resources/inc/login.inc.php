<?php

include_once 'connection.inc.php';
include_once __DIR__ . '/../lib/validator.lib.php';
include_once __DIR__ . '/../lib/encrypter.lib.php';

//POST for login
//runs when the 'login' form is submitted
//logs user in if input conforms to a user in the database
//logged in users are sent to profile.php 
if(isset($_POST['submitLogin']) && is_string($_POST['email']) && is_string($_POST['password'])){
    $loginValidator = new Validator;
    if ($loginValidator->validateEmail($loginValidator->cleanString($_POST['email']))){
        $email = $loginValidator->cleanString($_POST['email']);
    }
    $password = $loginValidator->cleanString($_POST['password']);

    $sqlFetchUser = "SELECT * FROM users WHERE Email = '$email'";
    $query = $pdo->prepare($sqlFetchUser);

    try {
        $query->execute();
    } catch(PDOException $exc){
        $errormsg = $exc;
    }

    $user = $query->fetch(PDO::FETCH_OBJ);

    if($query->rowCount() == 1){
        if (password_verify($password, $user->Password)){
            $_SESSION['firstname'] = $user->FirstName;
            $_SESSION['lastname'] = $user->LastName;
            $_SESSION['email'] = $user->Email;
            $_SESSION['userID'] = $user->UserID;
            $_SESSION['usertype'] = $user->IsAssistant;
            header("Location:profile.php");
        } else {
            echo '<script>window.location.href = "index.php"; alert("Login failed. Invalid password.")</script>';
        }
    } else {
        echo '<script>window.location.href = "index.php"; alert("Login failed. Invalid e-mail.")</script>';
    } 
 
}
?>