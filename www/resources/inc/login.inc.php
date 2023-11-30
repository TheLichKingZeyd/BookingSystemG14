<?php

include_once 'connection.inc.php';
include __DIR__ . '/../lib/validator.lib.php';
include __DIR__ . '/../lib/encrypter.lib.php';

//POST for login
//runs when the 'login' form is submitted
//logs user in if input conforms to a user in the database
//logged in users are sent to profile.php 
if(isset($_POST['submitLogin']) && is_string($_POST['email']) && $_POST['password']){
    $validator = new Validator;
    $encrypter = new Encrypter;
    if ($validator->validateEmail($validator->cleanString($_POST['email']))){
        $email = $validator->cleanString($_POST['email']);
    }
    $password = $encrypter->encryptStringXOR($validator->cleanString($_POST['password']));

    $sqlFetchUser = "SELECT * FROM user WHERE Email = '$email' AND Password = '$password'";
    $query = $pdo->prepare($sqlFetchUser);

    try {
        $query->execute();
    } catch(PDOException $exc){
        $errormsg = $exc;
    }

    $user = $query->fetch(PDO::FETCH_OBJ);

    if($query->rowCount() == 1){
        $_SESSION['firstname'] = $user['FirstName'];
        $_SESSION['lastname'] = $user['LastName'];
        $_SESSION['email'] = $user['Email'];
        $_SESSION['usertype'] = $user['IsAssistant'];
        header("Location:profile.php");
    }
    else {
        echo '<script>window.location.href = "index.php"; alert("Login failed. Invalid e-mail or password.")</script>';
    }
}
?>