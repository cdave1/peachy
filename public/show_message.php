<?php

$SECURITY = 1;

$title = "Email";

require("../config/config.inc.php");

function printMessage() {
	include(CONFIG_PATH . "db_config.inc.php");
	$db = mysql_connect($DBHOST, $DBUSER, $DBPASSWORD);
	mysql_select_db($DBNAME,$db);

	if (isset($_GET["messageid"])) {
		if (is_numeric($_GET["messageid"])) {
			$sql = mysql_query("select * from usrMessage where ixMessage = " . $_GET["messageid"], $db);
	
			while($result = mysql_fetch_array($sql, MYSQL_ASSOC)) {
				if (getLoggedInUserID() == $result["usrID"]) {
					if ($MESSAGE_UNREAD == $result["nStatus"]) {
						mysql_query("update usrMessage set nStatus = " . $MESSAGE_READ . " where ixMessage = " . $_GET["messageid"], $db);
					}
					
					print "<b>Received:</b> " . date("H:i, D jS of M Y", $result["dtTime"]) . "<br />";
					print "<b>From:</b> " . $result["txtSender"] . "<br />";
					print "<b>Subject:</b> " . $result["txtSubject"] . "</b><br /><br /><table border=1><tr><td>";
					print html_entity_decode($result["txtMessage"]);
					print "</td></tr></table>";
				} else {
					print "Invalid message id.";
				}
			} 
		} else {
			print "Invalid message id.";
		}
	} else {
		print "Invalid message id.";
	}
}

if (isLoggedIn()) {
	include($LAYOUT_ELEMENT_PATH . "simple_header.inc.php");
	printMessage();
	include($LAYOUT_ELEMENT_PATH . "simple_footer.inc.php");
}

?>
