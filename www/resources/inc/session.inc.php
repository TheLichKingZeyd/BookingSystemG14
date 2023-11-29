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
$username = $_SESSION['username'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$email = $_SESSION['email'];
$usertype = $_SESSION['usertype'];

//Require language files in languages
require get_language_file();
function get_language_file()
{
	$_SESSION['lang'] = $_SESSION['lang'] ?? 'en';
	$_SESSION['lang'] = $_GET['lang'] ?? $_SESSION['lang'];


	return "../www/resources/lan/".$_SESSION['lang'].".php";
}

//Set __ string to session language
function __($str)
{
	global $lang;
	if(!empty($lang[$str]))
	{
		return $lang[$str];
	}
	return $str;
}

?>