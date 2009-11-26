<?php

require("../config/config.inc.php");

$URI_QUERYSTRING = URI_QUERYSTRING();
$commandString = false;
if(isset($URI_QUERYSTRING[1])) {
	$commandString = urldecode($URI_QUERYSTRING[1]);
}

$commandParms=explode(" ",$commandString);

// Examples
// google -a dvds <---- searches google for the term 'dvds'
// google dvds <---- searches the default url for the term 'dvds'
// google -i dvds+nz <------ searchs google images for the term 'dvds+nz'


$command = $commandParms[0];
$objCommand = GetCommand($command);
$objOption = false;

if (false == $objCommand) {
	//print "0. No command found, default to google search";
	header("Location: http://www.google.com/search?q=" . $command);
} else {
	if (isset($commandParms[1])) {
		$strixOption = $commandParms[1];
		
		// is there a matching command? if not, check for default.
		if (false == $objCommand->GetOption($strixOption)) {
			$objOption = $objCommand->GetDefaultOption();
			if (false == $objOption) {
				$objOption = $objCommand->Options[0];
			} 
			if (0 == argumentCount($objOption->urlDirective)) {
				//print "1. No option found, default does not require args. " . $objOption->urlDirective;
				header("Location: " . $objOption->urlDirective);
			} else {
				// If we get to here, we have the default option. In such a case, we don't want 
				// to confuse the switch with the argument, so we can assume that the argument is the
				// first element.
				if (2 == count($commandParms)) {
					$args = explode(",",$commandParms[1]);
					//print "2. default option matches 1st parm. being called with args " . substituteURLQueryString($objOption->urlDirective, $args);
					header("Location: " . substituteURLQueryString($objOption->urlDirective, $args));
				} else if (2 < count($commandParms)) {
					$args = explode(",",$commandParms[2]);
					//print "3. default search on all commandParms imploded by comma " . substituteURLQueryString($objOption->urlDirective, $args);
					header("Location: " . substituteURLQueryString($objOption->urlDirective, $args));
				}
			}
		} else {
			$objOption = $objCommand->GetOption($strixOption);
			// Does this option expect arguments?
			if (0 == argumentCount($objOption->urlDirective)) {
				//print "4. Option found, but does not require arguments. " . $objOption->urlDirective;
				header("Location: " . $objOption->urlDirective);
			} else {
				if (isset($commandParms[2])) {
					$args = explode(",",$commandParms[2]);
					//print "5. Option found, uses arguments. " . substituteURLQueryString($objOption->urlDirective, $args);
					header("Location: " . substituteURLQueryString($objOption->urlDirective, $args));
				} else {
					// a switch was defined, but no arguments were provided
					//print "6. switch found - no arguments. Print usage message.";
				}
			}
		}
	} else {
		$objOption = $objCommand->GetDefaultOption();
		if (false == $objOption) {
			$objOption = $objCommand->Options[0];
		} 
		if (0 == argumentCount($objOption->urlDirective)) {
				//print "7. Option found, but does not require arguments. Redirect." . $objOption->urlDirective;
				header("Location: " . $objOption->urlDirective);
		} else {
			//print "8. switch found - no arguments. Print usage message.";
		}
	}
}

?>