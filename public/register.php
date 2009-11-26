<?php

$SECURITY = 1;

require("../config/config.inc.php");

$title = "Register";

include(LIB_SECURITY . "signup_functions.inc.php");
$freetrial = 1;

if (isLoggedIn()) {
	header("Location: /your");
} else {
	if (isset($_POST["step"])) {
		$step = $_POST["step"];
		if (is_numeric($step)) {
			if (1 == $step) {
				$nextpage = doSignUp();
				if (false != $nextpage) {
					header("Location: /your");
				} else {
					$main_include = APP_CONTENT . "signup_step1.inc.php";
					include(CONTENT_INCLUDE_FILE);
				}
			}
		} else {
			$main_include = APP_CONTENT . "signup_step1.inc.php";
			include(CONTENT_INCLUDE_FILE);
		}
	} else {
		$main_include = APP_CONTENT . "signup_step1.inc.php";
		include(CONTENT_INCLUDE_FILE);
	}
}

?>