<?php

//Session for user data
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

include("Include/login.inc.php");

//Gather session data from login
$username = $_SESSION['username'];
$forename = $_SESSION['forename'];
$surename = $_SESSION['surename'];
$email = $_SESSION['email'];

//Require language files in languages
require get_language_file();
function get_language_file()
{
	$_SESSION['lang'] = $_SESSION['lang'] ?? 'en';
	$_SESSION['lang'] = $_GET['lang'] ?? $_SESSION['lang'];


	return "languages/".$_SESSION['lang'].".php";
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