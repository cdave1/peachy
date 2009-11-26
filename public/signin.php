<?php

$SECURITY = 1;

require("../config/config.inc.php");

$title = "Sign in";

// If the user is already logged in, redirect to member_index
if (isLoggedIn()) {
	header("Location: /your");
} else {
	$main_include = LIB_SECURITY . "signin.inc.php";
	include(CONTENT_INCLUDE_FILE);
}

?>