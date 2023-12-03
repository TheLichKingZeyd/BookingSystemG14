<?php

//Session for user data
//runs if there is no session
//attempts to start a session
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

include("login.inc.php");

//Gather session data from login
//Collects user data into variables for use in html documents
$firstName = $_SESSION['firstname'];
$lastName = $_SESSION['lastname'];
$email = $_SESSION['email'];
$userID = $_SESSION['userID'];
$userType = $_SESSION['usertype'];

?>