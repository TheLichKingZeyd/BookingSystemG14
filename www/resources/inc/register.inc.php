<?php

include_once 'connection.inc.php';
include __DIR__ . '/../lib/validator.lib.php';
include __DIR__ . '/../lib/user.lib.php';
include __DIR__ . '/../lib/encrypter.lib.php';

//POST FOR REGISTER -- under construction
//runs when the 'register new user' form is submitted
//sends form data to database, registering a new user
if(isset($_POST['submitRegister']) && is_string($_POST['passReg']) && is_string($_POST['emailReg']) && is_string($_POST['firstNameReg']) && is_string($_POST['lastNameReg']) && is_string($_POST['roleReg'])){
    $validator = new Validator;
    $firstName = ucfirst(strtolower($validator->cleanString($_POST['firstNameReg'])));
    $lastName = ucfirst(strtolower($validator->cleanString($_POST['lastNameReg'])));
    $userNumber = generateUserNumber();
    if ($validator->validateEmail($_POST['emailReg'])){
        $email = $_POST['emailReg'];
    } else {
        // WRITE ERROR STUFF
    }
    $encrypter = new Encrypter;
    $password = $validator->validatePassword($_POST['passReg']);
    if ($validator->cleanString($_POST['roleReg']) == "Assistant"){
        $isAssistant = true;
    } elseif ($validator->cleanString($_POST['roleReg']) == "Student"){
        $isAssistant = false;
    }

    $newUser = new User($userNumber, $firstName, $lastName, $email, $password, $isAssistant);
    $sqlInsertUser = "INSERT INTO users (UserID, FirstName, LastName, Email, IsAssistant, Password) VALUES (:userID, :firstName, :lastName, :email, :isAssistant, :password)";
    $query = $pdo->prepare($sqlInsertUser);
    $query->bindParam(":userID", $newUser->userID, PDO::PARAM_INT);
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

function generateUserNumber(){
    include_once 'connection.inc.php';
    $sqlFetchUsers = "SELECT MAX(UserID) FROM users";
    $query = $pdo->prepare($sqlFetchUsers);

    try {
        $query->execute();
    } catch(PDOException $exc){
        $errormsg = $exc;
    }

    $userID = $query->fetchColumn();
    if ($query->rowCount()==0){
        return 100000;
    } elseif ($query->rowCount() > 0){
        $userNumber = $userID + 1;
        return $userNumber;
    }

}


?>