<?php

//POST for login 
if(isset($_POST['submitLogin'])){
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $errormsg = "";

    $sqlLog = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sqlLog);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if($count==1){
        $_SESSION['username'] = $username;
        $_SESSION['forename'] = $row['forename'];
        $_SESSION['surename'] = $row['surename'];
        $_SESSION['email'] = $row['email'];
        header("Location:profile.php");
    }
    else {
        echo '<script>window.location.href = "index.php"; alert("Login failed. Invalid username or password")</script>';
    }
}

//POST FOR REGISTER
if(isset($_POST['submitRegister'])){
    $usernameReg = $_POST['userReg'];
    $emailReg = $_POST['emailReg'];
    $passwordReg = $_POST['passReg'];
    $errormsg = "";

    $sqlReg = "INSERT INTO `user`(`username`, `email`, `password`) VALUES ('$usernameReg', '$emailReg', '$passwordReg' )";
    $query = mysqli_query($conn, $sqlReg);
    $_SESSION['username'] = $username;
    header("Location:profile.php");
}

?>