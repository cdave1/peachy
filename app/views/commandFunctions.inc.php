<?php
 
/// <summary>
/// 
/// </summary>
function showLatestCommands($limit, $orderBy) {
	$commandDataAccess = new commandDataAccess();
	$sqlCommands = $commandDataAccess->getCommands($limit, $orderBy);
	
	$commands = false;
	
	$ixCount = 0;
	
	while($arrCommands = mysql_fetch_array($sqlCommands)) {
		
		$commands[$ixCount] = new Command($arrCommands["ixCommand"], $arrCommands["strixCommand"], 
				$arrCommands["strDescription"], $arrCommands["scnmCreator"], $arrCommands["scnmModifiedBy"],
				$arrCommands["dtCreated"], $arrCommands["dtValidFrom"], 
				$arrCommands["dtValidTo"],  $arrCommands["dtLastModified"], 
				$arrCommands["optVisibility"], $arrCommands["ixfOptionDefault"]);
		$ixCount += 1;
	}
	$commandDataAccess->destroy();
	return $commands;
}

/// <summary>
/// 
/// </summary>
function CreateCommand() {
	$commandDataAccess = new commandDataAccess();
	$optionDataAccess = new optionDataAccess();
	
	$command = new Command(0, $_POST["strixCommand"], $_POST["strDescription"], getLoggedInUserScreenName(), 
			getLoggedInUserScreenName(), time(), time(), -1, 
			time(), 4, -1);
	$ixCommand = $commandDataAccess->createCommand($command);
	
	$strixOptions = $_POST["strixOptions"];
	$urlDirectives = $_POST["urlDirectives"];
	$strDescriptions = $_POST["strDescriptions"];
	$nCount = count($strixOptions);
	for ($i = 0; $i < $nCount; $i++) {
		$command->Options[$i] = new Option(0, $ixCommand, $strixOptions[$i], $strixOptions[$i], 
			translateURLQueryString($urlDirectives[$i]), $strDescriptions[$i], getLoggedInUserScreenName(), 
			getLoggedInUserScreenName(),time(), time(), -1, time(), 4);
		if (0 == $i) {
			// Set the default.
		}
	}
	
	foreach($command->Options as $option) {
		$optionDataAccess->createOption($option);
	}
	
	return $_POST["strixCommand"];
}

/// <summary>
/// 
/// </summary>
function UpdateCommand() {
	$commandDataAccess = new commandDataAccess();
	$optionDataAccess = new optionDataAccess();
	
	$oldCommand = GetCommand($_POST["strixCommand"]);
	$oldCommand->dtValidTo = time();
	
	$command = new Command(0, $_POST["strixCommand"], $_POST["strDescription"], $oldCommand->scnmCreator, 
			getLoggedInUserScreenName(), $oldCommand->dtCreated, time(), -1, 
			time(), 4, -1);
	$commandDataAccess->closeOldCommand($oldCommand);
	$ixCommand = $commandDataAccess->createCommand($command);
	
	$strixOptions = $_POST["strixOptions"];
	$urlDirectives = $_POST["urlDirectives"];
	$strDescriptions = $_POST["strDescriptions"];
	$nCount = count($strixOptions);
	for ($i = 0; $i < $nCount; $i++) {
		$oldOption = GetOption($strixOptions[$i]);
		$oldOption->dtValidTo = time();
		$optionDataAccess->closeOldOption($oldOption);
		
		$command->Options[$i] = new Option(0, $ixCommand, $strixOptions[$i], $strixOptions[$i],  
			translateURLQueryString($urlDirectives[$i]), $strDescriptions[$i], $oldCommand->scnmCreator, 
			getLoggedInUserScreenName(),time(), time(), -1, time(), 4);
	}
	
	foreach($command->Options as $option) {
		$optionDataAccess->createOption($option);
	}
	
	return $_POST["strixCommand"];
}

/// <summary>
/// 
/// </summary>
function GetCommand($strixCommand) {
	$commandDataAccess = new commandDataAccess();
	$sqlCommand = $commandDataAccess->getCommand($strixCommand);
	$command = false;
	
	if (0 < mysql_num_rows($sqlCommand)) {
		$arrCommand = mysql_fetch_array($sqlCommand);
		
		$command = new Command($arrCommand["ixCommand"], $arrCommand["strixCommand"], 
					$arrCommand["strDescription"], $arrCommand["scnmCreator"], $arrCommand["scnmModifiedBy"],
					$arrCommand["dtCreated"], $arrCommand["dtValidFrom"], 
					$arrCommand["dtValidTo"],  $arrCommand["dtLastModified"], 
					$arrCommand["optVisibility"], $arrCommand["ixfOptionDefault"]);
	}
	return $command;
}

/// <summary>
/// 
/// </summary>
function CreateOption() {
	$optionDataAccess = new optionDataAccess();
	
	$option = new Option(0, $_POST["ixfCommand"], $_POST["strixOption"], $_POST["strixOptionAlias"], 
			$_POST["urlDirective"], $_POST["strDescription"], getLoggedInUserScreenName(), 
			getLoggedInUserScreenName(),time(), time(), -1, time(), 4);
	$option->urlDirective = translateURLQueryString($option->urlDirective);
	$optionDataAccess->createOption($option);
	return $_POST["strixString"];
}

/// <summary>
/// 
/// </summary>
function UpdateOption() {
	$optionDataAccess = new optionDataAccess();
	
	$oldOption = GetOption($_POST["ixOption"]);
	$oldOption->dtValidTo = time();
	
	$option = new Option(0, $_POST["ixfCommand"], $_POST["strixOption"], $_POST["strixOptionAlias"], 
			$_POST["urlDirective"], $_POST["strDescription"], getLoggedInUserScreenName(), 
			$oldOption->scnmCreator, $oldOption->dtCreated, time(), -1, time(), 4);
	$option->urlDirective = translateURLQueryString($option->urlDirective);
	$optionDataAccess->closeOldOption($oldOption);
	$optionDataAccess->createOption($option);
	return $_POST["strixOption"];
}

/// <summary>
/// 
/// </summary>
function GetOption($strixOption) {
	$optionDataAccess = new optionDataAccess();
	$sqlOption = $optionDataAccess->getOption($strixOption);
	
	$arrOption = mysql_fetch_array($sqlOption);
	
	$option = new Option($arrOption["ixOption"], $arrOption["ixfCommand"], $arrOption["strixOption"], 
			$arrOption["strixOptionAlias"], $arrOption["urlDirective"], $arrOption["strDescription"],
			$arrOption["scnmModifiedBy"], $arrOption["scnmCreator"], $arrOption["dtCreated"], 
			$arrOption["dtValidFrom"], $arrOption["dtValidTo"],$arrOption["dtLastModified"], 
			$arrOption["optVisibility"]);
	return $option;
}

function GetOptionsForCommand($ixfCommand) {
	$optionDataAccess = new optionDataAccess();
	$sqlOptions = $optionDataAccess->getOptions("dtCreated", $ixfCommand);
	$ixCount = 0;
	
	$options = false;
	
	while($arrOption = mysql_fetch_array($sqlOptions)) {
	
		$options[$ixCount] = new Option($arrOption["ixOption"], $arrOption["ixfCommand"], $arrOption["strixOption"], 
			$arrOption["strixOptionAlias"], $arrOption["urlDirective"], $arrOption["strDescription"],
			$arrOption["scnmModifiedBy"], $arrOption["scnmCreator"], $arrOption["dtCreated"], 
			$arrOption["dtValidFrom"], $arrOption["dtValidTo"],$arrOption["dtLastModified"], 
			$arrOption["optVisibility"]);
		$ixCount += 1;
	}
	$optionDataAccess->Destroy();
	return $options;
}

/// <summary>
/// 
/// </summary>
function translateURLQueryString($urlDirective) {
	$translatedQuery = "";
	if (false === strpos($urlDirective, "http")) {
		$urlDirective = "http://" . $urlDirective;
	}
	$urlArray=parse_url($urlDirective);
	$queries = false;
	$queryString = false;
	if (isset($urlArray["query"])) {
		$query=$urlArray["query"];
		$variables=explode("&",$query);
		for ($i=0;$i<count($variables);$i++){
			$queryString=explode("=",$variables[$i]);
			$queries[$i]=$queryString[0];
		}
	}
	if (false != $queries) { 
		for ($j=0;$j<count($queries);$j++) {
			$translatedQuery .= $queries[$j] . "=*";
		}
		$urlArray["query"] = $translatedQuery;
	}
	

	
	return glueURL($urlArray);
}

function argumentCount($urlDirective) {
	return substr_count($urlDirective, "*");
}

/// <summary>
/// 
/// </summary>
function glueURL($parsed) {
	if (! is_array($parsed)) return false;
	$uri = '';
	if (isset($parsed['scheme'])) {
		$uri .= $parsed['scheme'] ? $parsed['scheme'].':'.((strtolower($parsed['scheme']) == 'mailto') ? '':'//'): '';
	}
	if (isset($parsed['user'])) {
		$uri .= $parsed['user'] ? $parsed['user'].($parsed['pass']? ':'.$parsed['pass']:'').'@':'';
	}
	if (isset($parsed['host'])) {
		$uri .= $parsed['host'] ? $parsed['host'] : '';
	}
	if (isset($parsed['port'])) {
		$uri .= $parsed['port'] ? ':'.$parsed['port'] : '';
	}
	if (isset($parsed['path'])) {
		$uri .= $parsed['path'] ? $parsed['path'] : '';
	}
	if (isset($parsed['query'])) {
		$uri .= $parsed['query'] ? '?'.$parsed['query'] : '';
	}
	if (isset($parsed['fragment'])) {
		$uri .= $parsed['fragment'] ? '#'.$parsed['fragment'] : '';
	}
	return $uri;
} 

/// <summary>
/// 
/// </summary>
function substituteURLQueryString($urlDirective, $args) {
	$newURL = $urlDirective;
	if (count($args) != argumentCount($urlDirective)) {
		return false;
	} else {
		$argCount = 0;
		while($argCount < count($args)) {
			$posToReplace = strpos($newURL, "\$arg");
			$newURL = preg_replace("(\*)", $args[$argCount], $newURL, 1);
			$argCount +=1;		
		}
	}
	return $newURL;
}

/// <summary>
/// 
/// </summary>
function getExecutableQueryString($command, $option) {
	$executableQuery = "";
	$urlArray=parse_url($option->urlDirective);
	$queries = false;
	$queryString = false;
	if (isset($urlArray["query"])) {
		$query=$urlArray["query"];
		$variables=explode("&",$query);
		for ($i=0;$i<count($variables);$i++){
			$queryString=explode("=",$variables[$i]);
			$queries[$i]=$queryString[0];
		}
	}
	if (false !== $queries) {
		$executableQuery = implode(",", $queries);
	}
	return $command->strixCommand . " " . $option->strixOption . " " . $executableQuery;
}

function getDefaultQueryString($command, $option) {
	$executableQuery = "";
	$urlArray=parse_url($option->urlDirective);
	$queries = false;
	$queryString = false;
	if (isset($urlArray["query"])) {
		$query=$urlArray["query"];
		$variables=explode("&",$query);
		for ($i=0;$i<count($variables);$i++){
			$queryString=explode("=",$variables[$i]);
			$queries[$i]=$queryString[0];
		}
	}
	if (false !== $queries) {
		$executableQuery = implode(",", $queries);
	}
	return $command->strixCommand . " " . $executableQuery;
}



function GetCommentsForItem($asinID) {
	$commentDataAccess = new commentDataAccess();
	$sqlComments = $commentDataAccess->retrieveCommentsForItem($asinID);
		
	$commentList = false;
	
	$ixCount = 0;
	while ($arrComments = mysql_fetch_array($sqlComments)) {
		$commentList[$ixCount] = new Comment($arrComments["ixComment"], $arrComments["usrID"],
						$arrComments["usrScreenName"], $arrComments["dtTime"],
						$arrComments["txtComment"], $arrComments["asinID"]);
		$ixCount += 1;
	}
	
	$commentDataAccess->Destroy();
	return $commentList;
}

function GetItemMembers($asin, $limit, $setFilter, $constType) {
	$itemDataAccess = new itemDataAccess();
	$sqlMembers = $itemDataAccess->getItemMembers($asin, $limit, $setFilter, $constType);
	
	$members = false;
	$ixCount = 0;
	
	while ($arrMembers = mysql_fetch_array($sqlMembers)) {
		$members[$ixCount] = new Member($arrMembers["id"], $arrMembers["email"], $arrMembers["firstname"],
				$arrMembers["lastname"], $arrMembers["ipaddress"], $arrMembers["creationdate"],
				$arrMembers["checksum1"], $arrMembers["usrScreenName"]);
		$ixCount += 1;
	}
	
	$itemDataAccess->Destroy();
	return $members;	
}

function InsertListItem($MemberListItem) {
	$itemDataAccess = new itemDataAccess();
	$ixList = $itemDataAccess->insertItem($MemberListItem);
	
	$resCanUserReceive = CanUserReceive($MemberListItem->Member->id);
		echo $resCanUserReceive;	
	if ($resCanUserReceive) {
		CreateRequestsForHaveUsers(GetEnglishMode(), $MemberListItem->ListItem->strProductName, $ixList, GetMemberID(), $MemberListItem->ListItem->asinID, $MemberListItem->ListItem->catID);
	}
}



// <summary>
// Sends an email to the specified user
// </summary>
function SendEmail($usrID, $subject, $from, $bodymessage) {
	include(FUNCTION_CONFIG_PATH . "path_config.inc.php");

	$db = mysql_connect($DBHOST, $DBUSER, $DBPASSWORD);
	mysql_select_db($DBNAME,$db);

	$header="From: " . $from . "\r\n" . "Reply-To: " . $from . "\r\n" . "X-Mailer: PHP/" . phpversion() . "\nContent-Type: text/html; charset=iso-8859-1";
	$Subject = $subject;

	$sqlUserInfo = mysql_query("SELECT * from usrBasic where id = " . $usrID, $db);
	$arrUserInfo = mysql_fetch_array($sqlUserInfo, MYSQL_ASSOC);
	
	$email_header = "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-1\"><link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"" . $STYLE_PATH . "aimScreenBase.css\" /></head><body id=\"LMR\">";
	$email_header = $email_header . "<table cellpadding=\"5\" border=\"0\"><tr><td class=\"email\">";
	$email_header = $email_header . "<center><img src=\"" . $IMAGE_PATH . "logo_print.gif\" border=\"0\"></center><br /><br />";
	$email_header = $email_header . "Hi " . $arrUserInfo["firstname"] . "! <br /><br />";
	$email_footer = "";
	$email_footer = $email_footer . "<br />";
	$email_footer = $email_footer . "</td></tr></table></body></html>";

	$message = sprintf($email_header);
	$message = $message . $bodymessage;
	$message = $message . "<hr />";
	$message = $message . "Please note: This e-mail was sent from a notification-only address that cannot accept incoming email. Please do not reply to this message.";
	$message = $message . "<br /><br />Thanks for using BandyBoo.<hr /><br />BandyBoo<br />The best place to share and swap your games, CDs, DVDs, and Books<br><a href=\"http://www.shareme.co.nz\">http://www.shareme.co.nz</a><br /><hr />";
	$message = $message . sprintf($email_footer);

	$recipient = $arrUserInfo["email"];
	
	$message = stripslashes($message);
	
	mail($recipient,stripslashes($Subject),$message,$header);
	
	mysql_query("insert into usrMessage values(0, " . $usrID . ", '" . $from . "', '" . $subject . "', " . time() . ", '" . htmlentities($message, ENT_QUOTES) . "', 0)", $db);
	mysql_close($db);
}

?>