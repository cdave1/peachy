<?php

class memberDataAccess {
	var $db;
	
	function memberDataAccess() {
		require(CONFIG_PATH . "db_config.inc.php");
		$this->db = mysql_connect($DBHOST, $DBUSER, $DBPASSWORD);
		mysql_select_db($DBNAME,$this->db);
	}

	function retrieveMemberByUsrID($usrID) {
		$sqlMemberInfo = mysql_query("select * from usrBasic where id = " . $usrID, $this->db);
		return $sqlMemberInfo;
	}

	function retrieveMemberByUsrScreenName($usrScreenName, $bool) {
		
	}
	
	function Destroy() {
		//settype(&$this, 'null');
	}
}



class feedbackDataAccess {
	var $db;
	
	function feedbackDataAccess() {
		require(CONFIG_PATH . "db_config.inc.php");
		$this->db = mysql_connect($DBHOST, $DBUSER, $DBPASSWORD);
		mysql_select_db($DBNAME,$this->db);
	}
	
	function retrieveFeedbackForMember($usrScreenName) {
		$strsqlFeedback = "select usrFeedback.* from usrFeedback join usrBasic where usrFeedback.ixfSendingUserID = usrBasic.id and usrBasic.usrScreenName = '" . htmlentities($usrScreenName, ENT_QUOTES) . "' order by dtTime desc";
		$sqlFeedback = mysql_query($strsqlFeedback, $this->db);
		return $sqlFeedback;
	}
	
	function Destroy() {
		//settype(&$this, 'null');
	}	
}

class commandDataAccess {
	var $db;
	
	function commandDataAccess() {
		require(CONFIG_PATH . "db_config.inc.php");
		$this->db = mysql_connect($DBHOST, $DBUSER, $DBPASSWORD);
		mysql_select_db($DBNAME,$this->db);
	}
	
	function createCommand($Command) {
		$strSqlInsertCommand = "Insert into wsCommand values(";
		$strSqlInsertCommand .= "0, ";
		$strSqlInsertCommand .= "'" . $Command->strixCommand . "', ";
		$strSqlInsertCommand .= "'" . $Command->strDescription . "', ";
		$strSqlInsertCommand .= "'" . $Command->scnmCreator . "', ";
		$strSqlInsertCommand .= "'" . $Command->scnmModifiedBy . "', ";
		$strSqlInsertCommand .= $Command->dtCreated . ", ";
		$strSqlInsertCommand .= $Command->dtValidFrom . ", ";
		$strSqlInsertCommand .= $Command->dtValidTo . ", ";
		$strSqlInsertCommand .= $Command->dtLastModified . ", ";
		$strSqlInsertCommand .= "'" . $Command->optVisibility . "', ";
		$strSqlInsertCommand .= $Command->ixfOptionDefault . ")";
		mysql_query($strSqlInsertCommand, $this->db);
		return mysql_insert_id();
	}
	
	function closeOldCommand($Command) {
		$strSqlCloseCommand = "Update wsCommand set dtValidTo = " . $Command->dtValidTo;
		$strSqlCloseCommand .= " where dtValidTo = -1 and strixCommand = '" . $Command->strixCommand . "'";
		mysql_query($strSqlCloseCommand, $this->db);
	}
	
	function getCommand($strixCommand) {
		$strsqlSelectCommand = "select * from wsCommand where dtValidTo = -1 and strixCommand = '" . addslashes(trim($strixCommand)) . "'";
		$sqlSelectCommand = mysql_query($strsqlSelectCommand, $this->db);
		return $sqlSelectCommand;
	}
	
	function getCommands($limit, $orderby) {
		$strsqlSelectCommands = "select * from wsCommand where dtValidTo = -1 order by " . $orderby . " desc limit " . $limit;
		$sqlSelectCommands = mysql_query($strsqlSelectCommands, $this->db);
		return $sqlSelectCommands;	
	}
	
	function Destroy() {
	}
}

class OptionDataAccess {
	var $db;
	
	function optionDataAccess() {
		require(CONFIG_PATH . "db_config.inc.php");
		$this->db = mysql_connect($DBHOST, $DBUSER, $DBPASSWORD);
		mysql_select_db($DBNAME,$this->db);
	}
	
	function createOption($Option) {
		$strSqlInsertOption = "Insert into wsOption values(";
		$strSqlInsertOption .= "0, ";
		$strSqlInsertOption .= $Option->ixfCommand . ", ";
		$strSqlInsertOption .= "'" . $Option->strixOption . "', ";
		$strSqlInsertOption .= "'" . $Option->strixOptionAlias . "', ";
		$strSqlInsertOption .= "'" . $Option->urlDirective . "', ";
		$strSqlInsertOption .= "'" . $Option->strDescription . "', ";
		$strSqlInsertOption .= "'" . $Option->scnmCreator . "', ";
		$strSqlInsertOption .= "'" . $Option->scnmModifiedBy . "', ";
		$strSqlInsertOption .= $Option->dtCreated . ", ";
		$strSqlInsertOption .= $Option->dtValidFrom . ", ";
		$strSqlInsertOption .= $Option->dtValidTo . ", ";
		$strSqlInsertOption .= $Option->dtLastModified . ", ";
		$strSqlInsertOption .= "'" . $Option->optVisibility . "')";
		mysql_query($strSqlInsertOption, $this->db);
	}
	
	function closeOldOption($Option) {
		$strSqlCloseOption = "Update wsOption set dtValidTo = " . $Option->dtValidTo;
		$strSqlCloseOption .= " where dtValidTo = -1 and strixOption = '" . $Option->strixOption . "'";
		mysql_query($strSqlCloseOption, $this->db);
	}
	
	function getOption($strixOption) {
		$strsqlSelectOption = "select * from wsOption where dtValidTo = -1 and strixOption = '" . $strixOption . "'";
		$sqlSelectOption = mysql_query($strsqlSelectOption, $this->db);
		return $sqlSelectOption;
	}
	
	function getOptions($orderby, $ixfCommand) {
		$strsqlSelectOptions = "select * from wsOption where dtValidTo = -1 and ixfCommand = " . $ixfCommand . " order by " . $orderby . " desc";
		
		$sqlSelectOptions = mysql_query($strsqlSelectOptions, $this->db);
		return $sqlSelectOptions;	
	}
	
	function Destroy() {
	}
}

?>