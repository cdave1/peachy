<table width="100%" id="optionBuilder">
<tr>
<td align="left">

<input type="hidden" id="nOptionField" name="nOptionField" <? if (false != $objCommand) { echo 'value="' . count($objCommand->Options) . '"'; } else { echo 'value="0"'; } ?> />
<a href="#" onClick="addOption();">Add Option</a><br />
<div id="options">
<? if (false != $objCommand) { 
	if (0 < count($objCommand->Options)) {
		$nCount = 0;
		foreach($objCommand->Options as $option) {
			
			echo "<div id='optionField" . $nCount . "'>";
			echo "<table border='0' cellpadding='3' cellspacing='0'>";
			echo "<tr><td valign='middle'>";
			echo "<b>Switch:</b>";
			echo "</td><td valign='middle'>";
			echo "<input type='text' id='strixOption" . $nCount . "' name='strixOptions[]' size='10' value='" . $option->strixOption . "' onBlur='parseURL(\"urlDirective" . $nCount . "\")'>";
			echo "</td></tr>";
			echo "<tr><td valign='middle'>";
			echo "<b>Full URL:</b>";
			echo "</td><td valign='middle'>";
			echo "<input type='text' id='urlDirective" . $nCount . "' name='urlDirectives[]' size='65' value='" . $option->urlDirective . "' onBlur='parseURL(\"urlDirective" . $nCount . "\")'><br />";
			echo "<div id='note'>";
			echo "<small>&quot;http://&quot; will be added to the begininning of the url if it is not specified.</small>";
			echo "</div>";
			echo "</td></tr>";
			echo "<tr><td valign='middle'>";
			echo "<b>Description:</b>";
			echo "</td><td valign='middle'>";
			echo "<input type='text' id='strDescription" . $nCount . "' name='strDescriptions[]' size='50' value='" . $option->strDescription . "' onBlur='parseURL(\"urlDirective" . $nCount . "\")'>";
			echo "</td></tr>";
			echo "</table>";
			echo "<a href='#' onClick='removeOption(\"optionField" . $nCount . "\");'>Remove</a>";
			echo "<hr />";
			echo "</div>";
			$nCount += 1;
			?>
			
			<?
		}
	}
 } ?>
 </div>
</td>
</tr>

</table>