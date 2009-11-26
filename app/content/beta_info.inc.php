<h3>Currently Closed for Beta testing</h3>

Already have an account? <a href="<? echo $SECURE_PATH; ?>signin.php">Sign in</a><br /><br />

<?php
	if (0 < strlen($error)) {
		print ("<table cellpadding=\"5\" align=\"center\" cellspacing=\"0\" border=\"0\" style=\"border: 1px solid #cc0000\" bgcolor=\"#ffcc99\">");
		print ("<tr><td><img src=\"" . $IMAGE_PATH . "img_form_error.gif\" border=\"0\"></td><td>");
		print("<b>There was an error with your submission</b><br /><br />");
		if (substr_count($error, "1") > 0) {
			print("You need to enter something in the &quot;Beta Invite Code&quot; field.<br>");
		}
		if (substr_count($error, "2") > 0) {
			print("Your &quot;Beta Invite Code&quot; did not match any of the available codes. Please check the code you received from a friend and then retype it.<br>");
		}
		print ("</td></tr></table><br />");
	}
?>

<form method="POST" action="betainvite.php">

<table border="0" width="100%" cellpadding="0">
<tr>
<td align="left" width="100%">


<table border="0" width="100%" cellpadding="2" class="side_menu_lightyellow">
<tr>
<td align="left" width="100%" colspan="2">
We're sorry - Comet is currently undergoing a beta-testing process and is not available to the general public.<br><br>However, you may have received an invitation from a friend in the form of an automatic email and <i>special</i> code! (If so, well aren't you a lucky thing??)
<br><br>
If you received such a code, please enter your code below to begin your free trial...
</td></tr>

<tr>

<td align="right"><b>Your&nbsp;&quot;Beta&nbsp;Invite&nbsp;Code&quot;:</b></td>

<td align="left"><input name="betainvite" type="text" size="28" value="<? if (0 < strlen($error)) { print "" . $_POST["betainvite"] . "\""; } if (isset($_POST["betainvite"])) { print "" . $_POST["betainvite"] . "\""; }?>"></td>

</tr>


<tr><td colspan="2">&nbsp;</td></tr>

<tr>
<td align="right" width="40">&nbsp;</td><td width="450"><input type="submit" value="Next Step">

<br />
<br />
</td>

</tr></table>

</form>

</td>

<td valign="top"></td></tr></table>

<br />
Comet does not sell or rent your personally identifying information to third parties. We may use information you provide here to send you special information about our service.
<br /><br />
The Comet service is available in New Zealand to selected subscribers age 18 and over and a major credit card is required.
<br /><br />
For privacy information, please consult our <a href="<? echo $PAGES_PATH; ?>privacy.php">Privacy Policy.</a>
<br /><br /><br /><br />