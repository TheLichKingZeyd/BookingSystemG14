<?php

include_once 'connection.inc.php';

//POST for login
//runs when the 'login' form is submitted
//logs user in if input conforms to a user in the database
//logged in users are sent to profile.php 
if(isset($_POST['submitLogin']) && is_string($_POST['user']) && $_POST['pass']){
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sqlFetchUser = "SELECT * FROM user WHERE Email = '$username' AND password = '$password'";
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
        $_SESSION['usertype'] = $user['IsAssistant'];
        header("Location:profile.php");
    }
    else {
        echo '<script>window.location.href = "index.php"; alert("Login failed. Invalid username or password")</script>';
    }
}
?>