<?php

$SECURITY = 1;

require("../config/config.inc.php");

$title = "Member Home Page";

$member_page = 1;

if (isset($_POST["login"])) 
{
	doLogin();
} 
else if (isset($_POST["signup"])) 
{
	doSignUp();
} 
else 
{
	$URI_QUERYSTRING = URI_QUERYSTRING();
	if (1 < count($URI_QUERYSTRING)) {
		$main_include = APP_CONTENT . "account.inc.php";
		DoLoginCheck($main_include, CONTENT_INCLUDE_FILE, $title);
	} else {
		$main_include = APP_CONTENT . "accounthome.inc.php";
		DoLoginCheck($main_include, CONTENT_INCLUDE_FILE, $title);
	}
}

?>