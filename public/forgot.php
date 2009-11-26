<?php

$SECURITY = 1;

require("../config/config.inc.php");

$title = "Forgot your password?";

if (isset($_POST["forgot_submit"])) 
{
	doRetrievePassword();
} else {
	$main_include = $SECURE_ELEMENT_PATH . "forgotpassword.inc.php";
	include(CONTENT_INCLUDE_FILE);
}

?>