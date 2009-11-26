<table width="100%" cellpadding="5" cellspacing="0" border="0">

<tr>
<td align="left" width="100%" colspan="2">
<h2>Create your peachy.ws account</h2></td></tr>

<tr>

<td width="200" valign="top">

If you're like us, you will <i>despise</i> spam. Your email address will not be shared.

</td>

<td width="550">

<?php

if (isset($_GET["error"])) {
	print ("<div id=\"errorBox\">");
	print("<b>Oops! You might have missed something:</b><br /><small><ul>");
	if (substr_count($_GET["error"], "4") > 0) {
		print("<li>You need to enter a Screen Name.<br>");
	}
	if (substr_count($_GET["error"], "0") > 0) {
		print("<li>Your screen name is already being used by someone else. We've suggested a different one for you...<br>");
	}
	if (substr_count($_GET["error"], "9") > 0) {
		print("<li>You need to enter something in the &quot;First Name&quot; field.<br>");
	}
	if (substr_count($_GET["error"], "1") > 0) {
		print("<li>You need to enter something in the &quot;Last Name&quot; field.<br>");
	}
	if (substr_count($_GET["error"], "2") > 0) {
		print("<li>Your email address does not contain a &quot;@&quot; character, or it contains a space. Please retype it.<br>");
	} 
	if (substr_count($_GET["error"], "3") > 0) {
		print("<li>You need to enter something in the &quot;My Email Address&quot; field.<br>");
	}
	if (substr_count($_GET["error"], "5") > 0) {
		print("<li>Your password contains illegal characters, or is less than five characters long. Please retype it.<br>");
	} 
	if (substr_count($_GET["error"], "6") > 0) {
		print("<li>Your second password does not match the first. Please retype it.<br>");
	}
	if (substr_count($_GET["error"], "7") > 0) {
		print("<li>The email address you entered is already being used by another user. Please choose another email address.<br>");
	}
	if (substr_count($_GET["error"], "8") > 0) {
		print("<li>The email address you entered contains illegal characters. Please remove any &quot;quotation marks&quot; or spaces and try again.");
	}
	print ("</ul></small></div>");
}

?>

<form id="form" method="POST" action="/register">

<input type="hidden" name="step" value="1">

<table summary="Sign-up Form" cellpadding="6" cellspacing="0">

<tr class="formSpecial">
<td colspan="2">Your screen name will be seen by other users.</td></tr>
</tr>

<tr>
<th class="right"><b>Screen Name:</b></th>
<td><input name="screenname" type="text" size="50" <? if (isset($_GET["error"])) { print "value=\"" . htmlentities(urldecode($_GET["screenname"])) . "\""; } ?> /><br />
<small>Choose carefully - you won't be able to change your screen name once signed up.</small></td>
</tr>

<tr>
<th class="right"><b>Email&nbsp;address:</b></th>
<td><input name="email1" type="text" size="50" value="<? if (isset($_GET["error"])) { print "" . htmlentities(urldecode($_GET["email1"])) . "\""; } if (isset($_GET["email1"])) { print "" . htmlentities(urldecode($_GET["email1"])) . "\""; }?>" />
<br /><small>We'll send you a confirmation email to this address.</small></td>
</tr>

<tr class="formSpecial">
<td colspan="2">Make sure your password is at least <b>6 characters long</b>, and hard for others to copy. Once you're signed up, you can change your password as often as you like.</td>
</tr>

<tr>
<th class="right"><b>Enter a new password:</b></th>
<td><input name="password1" type="password" size="30" /></td>
</tr>

<tr>
<th class="right"><b>Type&nbsp;it&nbsp;again:</b></th>
<td><input name="password2" type="password" size="30" /></td>
</tr>

<tr>
<td></td>
<td width="450"><input type="submit" value="Continue" /></td>
</tr>

</table>

</form>
&nbsp;

</td>

</tr>

</table>