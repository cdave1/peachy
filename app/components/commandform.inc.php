<?php

$command = false;
$objCommand = false;

$URI_QUERYSTRING = URI_QUERYSTRING();

if(isset($URI_QUERYSTRING[1])) {
	$command = $URI_QUERYSTRING[1];
}

if (false != $command) {
	if ("edit" == $command) {
		// Load the command.
		$objCommand = GetCommand($URI_QUERYSTRING[2]);
	}
}

if (false == $objCommand) { 
	DisplayTitle('Create a command'); 
} else { 
	DisplayTitle('Edit "' . $objCommand->strixCommand . '"');
}

print ("<div id='errorBox'></div>");

?>

<form id="form" method="POST" <? if (false == $objCommand) { echo 'action="/command/create"'; } else { echo 'action="/command/update"'; } ?>>

<table width="100%" border="0" cellpadding="2" class="side_menu_lightyellow">

<tr>
<td align="right"><b>Command:</b></td>
<td align="left"><input type="text" name="strixCommand" size="30" <? if (false != $objCommand) { echo 'value="' . $objCommand->strixCommand . '"'; } ?>><br />
<small>Letters or numbers only. 20 Characters max.</small></td>
</tr>

<tr>
<td align="right"><b>Descriptive Name:</b></td>
<td align="left"><input type="text" name="strDescription" size="50" <? if (false != $objCommand) { echo 'value="' . $objCommand->strDescription . '"'; } ?>></td>
</tr>

<tr>
<td align="right"><b>Options:</b></td>
<td align="left"><small><?php include(APP_COMPONENTS . "optionBuilder.inc.php"); ?></small></td>
</tr>

<tr>
<td align="right">&nbsp;</td>
<td align="left">
<div id="commandUrlElements"></div><br />
</td>
</tr>


<!--<tr>
<td align="right"><b>Visibility:</b></td>
<td align="left">
<input type="radio" name="optVisibility" value="4"<? if (false != $objCommand) { if (4 == $objCommand->optVisibility) { echo " checked"; } } else { echo "checked"; } ?>>Everyone can edit this command<br />
<input type="radio" name="optVisibility" value="2"<? if (false != $objCommand) { if (2 == $objCommand->optVisibility) { echo " checked"; } } ?>>Everyone can see this command, but only I can edit it<br />
<input type="radio" name="optVisibility" value="1"<? if (false != $objCommand) { if (1 == $objCommand->optVisibility) { echo " checked"; } } ?>>Just I can see and edit this command<br />
</td>
</tr>-->

<tr>
<td align="right">&nbsp;</td>
<td align="left">
<?php

if (false == $objCommand) { 
	echo '<input type="submit" value="Create Command">';
} else { 
	echo '<input type="submit" value="Update Command">';
}

?>

</td>
</tr>

</table>

</form>