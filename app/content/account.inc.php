<?php


$command = false;

$URI_QUERYSTRING = URI_QUERYSTRING();

if(isset($URI_QUERYSTRING[1])) {
	$command = $URI_QUERYSTRING[1];
}

if (false != $command) {
	if ("email" == $command) {
		DisplayTitle("Change Email Login");
		DisplayEmailLogin('');
	} else if ("messages" == $command) {
		DisplayTitle("Your Messages");
		DisplayMessages();
	} else if ("newemail" == $command) {
		DisplayTitle("Change Email Login");
		ChangeEmailLogin();
	} else if ("profile" == $command) {
		DisplayTitle("Your Profile");
		DisplayProfileInfo();
	} else if ("profilechange" == $command) {
		DisplayTitle("Your Profile");
		ChangeProfileInformation();
	} else {
		DisplayAccountWelcome();
	}
} else {
	DisplayAccountWelcome();
}

function DisplayProfileInfo() {
}

function ChangeProfileInformation() {
}








function printMessageSelector($command)
{
	print "<form name=\"emailMode\">";
	print "<select name=\"navi\" onChange=\"email_go()\">";
	$htmlModeOptions = "";	
		
	$htmlModeOptions .= "<option value=\"" . $SECURE_PATH . "member_index.php?c=" . $command . "\"";
	if(!isset($_GET["msgshow"])) {
		$htmlModeOptions .= " selected";
	}
	$htmlModeOptions .= ">All Messages</a></option>";
	
	$htmlModeOptions .= "<option value=\"" . $SECURE_PATH . "member_index.php?c=" . $command . "&msgshow=" . $MESSAGE_UNREAD . "\"";
	if (isset($_GET["msgshow"]) && $MESSAGE_UNREAD == $_GET["msgshow"]) {
		$htmlModeOptions .= " selected";
	}
	$htmlModeOptions .= ">Messages you haven't read</a><br />";
	
	$htmlModeOptions .= "<option value=\"" . $SECURE_PATH . "member_index.php?c=" . $command . "&msgshow=" . $MESSAGE_READ . "\"";
	if (isset($_GET["msgshow"]) && $MESSAGE_READ == $_GET["msgshow"]) {
		$htmlModeOptions .= " selected";
	}
	$htmlModeOptions .= ">Messages you've read</a><br />";
	
	echo $htmlModeOptions;
	print "</select>";
	print "</form>";
}




//====================================================================
// Allows the user to view and change their login details. The 
// information is included within a form. Below the form is a submit button
// which saves the information. The user must enter their password
// when changing their email login.
//====================================================================
function DisplayEmailLogin($error) {
	include(CONFIG_PATH . "db_config.inc.php");
	$db = mysql_connect($DBHOST, $DBUSER, $DBPASSWORD);
	mysql_select_db($DBNAME,$db);

	$usrID = getLoggedInUserID();

	$login_sql = mysql_query("select * from usrBasic where id = " . $usrID, $db);

	$login_info = mysql_fetch_array($login_sql);

	if (0 < strlen($error)) {
		print ("<table cellpadding=\"5\" align=\"center\" cellspacing=\"0\" border=\"0\" style=\"border: 1px solid #cc0000\" bgcolor=\"#ffcc99\">");
		print ("<tr><td><img src=\"" . $IMAGE_PATH . "img_form_error.gif\" border=\"0\"></td><td>");
		print("<b>There was an error with your login information</b><br /><br />");
		if (substr_count($error, "2") > 0) {
			print($IMAGE_ARROW . "Your &quot;New Email&quot; address is not valid. Please retype it.<br>");
		} 
		if (substr_count($error, "3") > 0) {
			print($IMAGE_ARROW . "You need to enter something in the &quot;New Email&quot; field.<br>");
		} 
		if (substr_count($error, "5") > 0) {
			print($IMAGE_ARROW . "You did not enter your password. You will need to enter one in order to save your new email address.<br>");
		}
		if (substr_count($error, "7") > 0) {
			print($IMAGE_ARROW . "The email address you entered is already being used. Please choose another email address.<br>");
		}
		if (substr_count($error, "8") > 0) {
			print($IMAGE_ARROW . "Incorrect password entered. Please retype it.<br>");
		}
		print ("</td></tr></table><br />");
	}

?>

<form method="POST" action="/your/newemail">

<table border="0" width="100%" cellpadding="2" class="side_menu_lightyellow">


<tr>

<td align="left" width="100%" colspan="2">

<b>Change Your Contact Email Address:</b>

</td></tr>

<tr>

<td align="right"><b>Current&nbsp;Email:</b></td>

<td align="left">

<input name="oldemail" type="text" size="35" value="<? echo $login_info["email"]; ?>" disabled></td>
</tr>

<tr>
<td align="right"><b>New&nbsp;Email:</b></td>

<td align="left"><input name="email" type="text" size="35" <? if (strlen($error) > 0) { print "value=\"" . $_POST["email"] . "\""; } ?>></td>

</tr>

<tr>

<td colspan="2"><br /><small>Your password is required to save this change.</small></td>

</tr>

<tr>

<td align="right"><b>Your&nbsp;password:</b></td>

<td align="left"><input name="password1" type="password" length="30"></td>
</tr>

<tr>
<td align="right" width="40">&nbsp;</td><td width="450"><br /><input type="submit" value="Save Changes">

<br />
<br />
<br />
</td>


</tr></table>

</form>

<?php
	print_r(mysql_fetch_array($login_sql));
}






//====================================================================
// Displays a form containing the user's delivery address. They can
// change this and save it.
//====================================================================
function DisplayMessages() {
	include(CONFIG_PATH . "db_config.inc.php");
	$db = mysql_connect($DBHOST, $DBUSER, $DBPASSWORD);
	mysql_select_db($DBNAME,$db);

	$usrID = getLoggedInUserID();

	$strMessages = "select * from usrMessage where usrID = " . $usrID;
	if (isset($_GET["msgshow"])) {
		$nMsgShow = $_GET["msgshow"];
		if (is_numeric($nMsgShow)) {
			$strMessages .= " and nStatus = " . $nMsgShow;
		}
	}
	$strMessages .= " order by dtTime desc";

	$sqlMessages = mysql_query($strMessages, $db);
?>

<table cellpadding="0" cellspacing="0" border="0">

<tr>

<td class="emailheader"><b>From:</b></td><td class="emailheader"><b>Subject:</b></td><td class="emailheader"><b>Received:</b></td>

</tr>

<?php
	while($arrMessages = mysql_fetch_array($sqlMessages)) {
?>

<? 
if ($MESSAGE_UNREAD == $arrMessages["nStatus"]) { echo "<tr class=\"emailunread\">"; }
else { echo "<tr class=\"emailread\">"; }
?>

<td class="emailsender">
<? 
echo $arrMessages["txtSender"]; 
?>
</td>

<td class="emailsubject">

<a href="<? echo $SECURE_PATH; ?>show_message.php?messageid=<? echo $arrMessages["ixMessage"]; ?>" target="_new">
<? 
echo $arrMessages["txtSubject"]; 
?>
</a></td>
<td class="emaildate">
<? 
echo date("H:i, D jS of M", $arrMessages["dtTime"]); 
?>
</td>

</tr>

<?php
}
?>

</table>

<?php
}





// =================================================================
// 
// =================================================================
function ChangeEmailLogin() {
	include(CONFIG_PATH . "db_config.inc.php");
	$db = mysql_connect($DBHOST, $DBUSER, $DBPASSWORD);
	mysql_select_db($DBNAME,$db);

	$usrID = getLoggedInUserID();

	$error = "";

	$email = $_POST["email"];
	$password = $_POST["password1"];

	if (!validateEmail($email)) {
		if (strlen($email) < 1) {
			$error = $error . "3,";
		} else {
			$error = $error . "2,";
		}
	} 
	if (0 == strlen($password)) {
		$error = $error . "5,";
	} else {
		if (false == doPasswordCheck($password)) {
			$error = $error . "8";
		}
	}

	$sql = "SELECT * from usrBasic where email = '" . htmlentities($email, ENT_QUOTES) . "'";
	$result = mysql_query($sql) or die(mysql_error());
	if (mysql_num_rows($result) >= 1) {
		$error = $error . "7";
	}

	if (0 < strlen($error)) {
		DisplayEmailLogin($error);
	} else {
		$sql = "UPDATE usrBasic set email = '" . htmlentities($email, ENT_QUOTES) . "' where id = " . $usrID;
		mysql_query($sql);
		print "Email login address was updated.<br /><br />";
		
		DisplayEmailLogin("");		
	}
}

?>