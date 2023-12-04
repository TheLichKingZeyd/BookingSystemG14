<?php

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