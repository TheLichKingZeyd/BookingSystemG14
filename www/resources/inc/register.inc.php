<?php

include_once 'connection.inc.php';
include 'lib/validator.lib.php';
include 'lib/user.lib.php';

//POST FOR REGISTER -- under construction
//runs when the 'register new user' form is submitted
//sends form data to database, registering a new user
if(isset($_POST['submitRegister']) && is_string($_POST['passReg']) && is_string($_POST['emailReg']) && is_string($_POST['firstNameReg']) && is_string($_POST['lastNameReg'])){
    $validator = new Validator;
    $firstName = ucfirst(strtolower($validator->cleanString($_POST['firstNameReg'])));
    $lastName = ucfirst(strtolower($validator->cleanString($_POST['lastNameReg'])));
    $userNumber = generateUserNumber();
    if ($validator->validateEmail($_POST['emailReg'])){
        $email = $_POST['emailReg'];
    } else {
        // WRITE ERROR STUFF
    }
    $password = $validator->validePassword($_POST['passReg']);

    $sqlFetchUser = "SELECT * FROM users WHERE Email = '$email' AND password = '$password'";
    $query = $pdo->prepare($sqlFetchUser);

    try {
        $query->execute();
    } catch(PDOException $exc){
        $errormsg = $exc;
    }

    $user = $query->fetch(PDO::FETCH_OBJ);

    if($query->rowCount() == 1){
        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $user['FirstName'];
        $_SESSION['lastname'] = $user['LastName'];
        $_SESSION['email'] = $user['Email'];
        $_SESSION['usertpye'] = $user['IsAssistant'];
        header("Location:profile.php");
    }
    else {
        echo '<script>window.location.href = "index.php"; alert("Login failed. Invalid username or password")</script>';
    }
}

function generateUserNumber(){
    include_once 'connection.inc.php';
    $sqlFetchUsers = "SELECT * FROM users";
    $query = $pdo->prepare($sqlFetchUsers);

    try {
        $query->execute();
    } catch(PDOException $exc){
        $errormsg = $exc;
    }

    $users = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount()==0){
        return 100000;
    } elseif ($query->rowCount() > 0){
        $userNumber = 100000;
        foreach($users as $user){
           if ($userNumber == $user->userNumber){
                $userNumber++;
           }
        }
        return $userNumber;
    }

}


?>