<?php

class Comment {
	var $ixComment = -1;
	var $usrID = -1;
	var $usrScreenName = "";
	var $dtTime = -1;
	var $txtComment = "";
	var $asinID = "";
	
	function Comment($ixComment, $usrID, $usrScreenName, $dtTime, $txtComment, $asinID)
	{
		$this->ixComment = $ixComment;
		$this->usrID = $usrID;
		$this->usrScreenName = $usrScreenName;
		$this->dtTime = $dtTime;
		$this->txtComment = $txtComment;
		$this->asinID = $asinID;
	}
	
	function DisplayBrowser() {
		print "<div id=\"usrComment\">";
		print "<div id=\"txtComment\">";
		print $this->txtComment;
		print "</div>";
		print "<div id=\"infoComment\">";
		print "By <a href=\"" . PAGES_PATH . "member.php?n=" . $this->usrScreenName . "\">";
		print $this->usrScreenName;
		print "</a> on " . date("H:i, D jS of M Y", $this->dtTime);
		print "</div>";
		print "</div>";
	}
}



class Member {
	var $id = -1;
	var $email = "";
	var $firstname = "";
	var $lastname = "";
	var $ipaddress = "";
	var $creationdate = -1;
	var $checksum1 = "";
	var $usrScreenName = "";
	
	function Member($id, $email, $firstname, $lastname, $ipaddress, $creationdate, $checksum1, $usrScreenName)
	{
		$this->id = $id;
		$this->email = $email;
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->ipaddress = $ipaddress;
		$this->creationdate = $creationdate;
		$this->checksum1 = $checksum1;
		$this->usrScreenName = $usrScreenName;	
	}
	
	function DisplayBrowser($isSmall) {
		$sMemberPhoto = "";
		if ($isSmall) {
			if (GetMemberID() == $this->id) {
				$sMemberPhoto = "<table id=\"p2\" width=\"100%\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"fade-6092BF\">";
			} else {
				$sMemberPhoto = "<table width=\"100%\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
			}
			$sMemberPhoto .= "<tr>";
			$sMemberPhoto .= "<td align=\"left\">";
			$sMemberPhoto .= "<a href=\"" . PAGES_PATH . "member.php?n=" . $this->usrScreenName . "\">";
			//	$sMemberPhoto .= "<img class=\"small_avatar_image\" width=\"30\" height=\"30\" src=\"" . $IMAGE_PATH . "members/" . $this->usrScreenName . "_avatar.jpg\" />";
			$sMemberPhoto .= "<img class=\"small_avatar_image\" width=\"30\" height=\"30\" src=\"" . $IMAGE_PATH . "members/usr_noavatar.gif\" />";
			$sMemberPhoto .= "</a>";
			$sMemberPhoto .= "</td>";
			$sMemberPhoto .= "<td width=\"100%\" align=\"left\"><small><a href=\"" . $PAGES_PATH . "member.php?n=" . $this->usrScreenName . "\">" . $this->usrScreenName . "</a></small><br /><br />";
			
			$sMemberPhoto .= "</td>";
			$sMemberPhoto .= "</tr>";
			$sMemberPhoto .= "</table>";
		} else {
			$sMemberPhoto = "<div id=\"account_home_header\">";
			$sMemberPhoto .= "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
			$sMemberPhoto .= "<tr>";
			$sMemberPhoto .= "<td align=\"left\">";
			$sMemberPhoto .= "<a href=\"" . PAGES_PATH . "member.php?n=" . $this->usrScreenName . "\">";
			$sMemberPhoto .= "<img class=\"avatar_image\" width=\"50\" height=\"50\" src=\"" . IMAGE_PATH . "members/usr_noavatar.gif\" />";
			$sMemberPhoto .= "</a>";
			$sMemberPhoto .= "</td>";
			$sMemberPhoto .= "<td width=\"100%\" align=\"left\"><a href=\"" . $PAGES_PATH . "member.php?n=" . $this->usrScreenName . "\">" . $this->usrScreenName . "</a><br /><br />";
			
			$sMemberPhoto .= "</td>";
			$sMemberPhoto .= "</tr>";
			$sMemberPhoto .= "</table></div><br />";
		}
		return $sMemberPhoto;
	}
	
	function DisplayMemberLink() {
		return "<a href=\"" . $PAGES_PATH . "member.php?n=" . $this->usrScreenName . "\">" . $this->usrScreenName . "</small></a>";
	}
}



class FeedBack {
	var $ixFeedback = -1;
	var $ixfSendingUserID = -1;
	var $usrRequestingUserScreenName = "";
	var $txtMessage = "";
	var $dtTime = -1;
	var $ixfRequest = -1;
	var $nScore = -1;
	
	function Feedback($ixFeedback, $ixfSendingUserID, $usrRequestingUserScreenName, $txtMessage,
				$dtTime, $ixfRequest, $nScore)
	{
		$this->ixFeedback = $ixFeedback;
		$this->ixfSendingUserID = $ixfSendingUserID;
		$this->usrRequestingUserScreenName = $usrRequestingUserScreenName;
		$this->txtMessage = $txtMessage;
		$this->dtTime = $dtTime;
		$this->ixfRequest = $ixfRequest;
		$this->nScore = $nScore;
	}
	
	function DisplayBrowser() {
		print "<div id=\"usrFeedback\">";
		print "<div id=\"txtFeedback\">";
		print "<b>Score:</b>&nbsp;";
		print $this->nScore;
		print "<br />";
		print $this->txtMessage;
		print "</div>";
		print "<div id=\"infoFeedback\">";
		print "From <a href=\"" . PAGES_PATH . "member.php?n=" . $this->usrRequestingUserScreenName . "\">";
		print $this->usrRequestingUserScreenName;
		print "</a> on " . date("H:i, D jS of M Y", $this->dtTime);
		print "</div>";
		print "</div>";	
	}
}

class Command {
	var $ixCommand = -1;
	var $strixCommand = "";
	var $strDescription = "";
	var $scnmCreator = "";
	var $scnmModifiedBy = "";
	var $dtCreated = -1;
	var $dtValidFrom = -1;
	var $dtValidTo = -1;
	var $dtLastModified = -1;
	var $optVisibility = -1;
	var $ixfOptionDefault = -1;
	var $Options = Array();
	
	function Command($ixCommand, $strixCommand, $strDescription, $scnmCreator, $scnmModifiedBy, $dtCreated, 
			$dtValidFrom, $dtValidTo, $dtLastModified, $optVisibility, $ixfOptionDefault) {

		$this->ixCommand = $ixCommand;
		$this->strixCommand = $strixCommand;
		$this->strDescription = $strDescription;
		$this->scnmCreator = $scnmCreator;
		$this->scnmModifiedBy = $scnmModifiedBy;
		$this->dtCreated = $dtCreated;
		$this->dtValidFrom = $dtValidFrom;
		$this->dtValidTo = $dtValidTo;
		$this->dtLastModified = $dtLastModified;
		$this->optVisibility = $optVisibility;
		$this->ixfOptionDefault = $ixfOptionDefault;
		if (0 != $ixCommand) {
			$this->Options = GetOptionsForCommand($this->ixCommand);
		}
	}
	
	function GetOption($strixOption) {
		foreach($this->Options as $option) {
			if ($option->strixOption === $strixOption) {
				return $option;
			}
		}
		return false;
	}
	
	function GetDefaultOption() {
		foreach($this->Options as $option) {
			if ($option->ixOption === $this->ixfOptionDefault) {
				return $option;
			}
		}
		return false;
	}
}

class Option {
	var $ixOption = -1;
	var $ixfCommand = -1;
	var $strixOption = "";
	var $strixOptionAlias = "";
	var $urlDirective = "";
	var $strDescription = "";
	var $scnmModifiedBy = "";
	var $scnmCreator = "";
	var $dtCreated = -1;
	var $dtValidFrom = -1;
	var $dtValidTo = -1;
	var $dtLastModified = -1;
	var $optVisibility = -1;
	
	function Option($ixOption, $ixfCommand, $strixOption, $strixOptionAlias, $urlDirective, 
			$strDescription, $scnmModifiedBy, $scnmCreator, 
			$dtCreated, $dtValidFrom, $dtValidTo, 
			$dtLastModified, $optVisibility) {
		$this->ixOption = $ixOption;
		$this->ixfCommand = $ixfCommand;
		$this->strixOption = $strixOption;
		$this->strixOptionAlias = $strixOptionAlias;
		$this->urlDirective = $urlDirective;
		$this->strDescription = $strDescription;
		$this->scnmModifiedBy = $scnmModifiedBy;
		$this->scnmCreator = $scnmCreator;
		$this->dtCreated = $dtCreated;
		$this->dtValidFrom = $dtValidFrom;
		$this->dtValidTo = $dtValidTo;
		$this->dtLastModified = $dtLastModified;
		$this->optVisibility = $optVisibility;
	}
}


?>