<div class="searchheader">
Welcome, <?php print getLoggedInUserScreenName(); ?>!
</div>

<table border="0" cellpadding="0" cellspacing="0" width="100%">

<tr>

<td width="50%" valign="top">

<?php

$nUserMessageCount = getUserMessageCount();
if (0 < $nUserMessageCount) {
	print "<div class='account_home_box'><ul>";
	print "<li>You have <a href=\"/your/messages\">" . $nUserMessageCount . " unread ";
	if (1 == $nUserMessageCount) {
		print "message.</a>";
	} else {
		print "messages.</a>";
	}
	print "</ul></div>";
}
?>



<b>Your Settings:</b><br />
<? echo IMAGE_ARROW; ?><a href="/your/email">Email Login</a><br />
<? echo IMAGE_ARROW; ?><a href="/your/messages">Your Messages</a><br />
</td>

<td width="50%" valign="top">

<div style="margin: 15px 5px 15px 5px">

</div>

</td>

</tr>

</table>