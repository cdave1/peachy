<?php

require("../config/config.inc.php");

$title = "Search Results";

// Allows:
// Creating of commands
// -- OR --
// Editing of existing ones
// Any submission goes to another page which REDIRECTS back here with the appropriate ID


$command = false;

$URI_QUERYSTRING = URI_QUERYSTRING();

if(isset($URI_QUERYSTRING[1])) {
	$command = $URI_QUERYSTRING[1];
}

if (false != $command) {
	if ("new" == $command) {
		$title = "Create Command";
		$main_include = APP_COMPONENTS . "commandform.inc.php";
		DoLoginCheck($main_include, CONTENT_INCLUDE_FILE, $title);
	} else if ("create" == $command) {
		$strixCommand = CreateCommand();
		header("Location: /command/edit/" . $strixCommand);
	} else if ("edit" == $command) {
		$title = "Edit Command";
		$main_include = APP_COMPONENTS . "commandform.inc.php";
		DoLoginCheck($main_include, CONTENT_INCLUDE_FILE, $title);		
	} else if ("update" == $command) {
		$strixString = UpdateCommand();
		header("Location: /command/edit/" . $strixString);
	} else {
		
	}
} else {
}

//include(CONTENT_INCLUDE_FILE);

?>