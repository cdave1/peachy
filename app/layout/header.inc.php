<div align="center">
<table width="100%" class="header_logo" cellspacing="0" cellpadding="5" border="0" align="center">
<tr>
<td width="75%" align="left" valign="middle">
<? include(APP_COMPONENTS . "commandLine.inc.php"); ?>
</td>
<td width="25%" align="right" valign="top">
<!--<img src="<? echo IMAGE_PATH; ?>bandyboo_logo.gif" width="151" height="35" border="0" /><br />-->
<span style="font-size: 250%; font-family: georgia, bodoni, times; font-weight: bold; color: white">peachy.ws</span><br />
<small>
<a href="/page/beta">not even beta?</a>
</small>
</td>
</tr>
</table>
<table width="100%" cellspacing="0" cellpadding="5" border="0" align="center" class="header_menu">
<? if(!isset($homepage)) { ?>
<tr>
<td width="50%" align="left" valign="middle">
<?php if (isLoggedIn()) { ?>
<a href="/command/new">Create a command</a>&nbsp;|&nbsp;
<?php } ?>
<a href="/browse">Browse Commands</a>
</td>
<td width="50%" align="right" valign="middle">
<?php if (isLoggedIn()) { 
	$nMessages = getUserMessageCount();
	if (1 < $nMessages) {
		print "You have <a href=\"/your/messages\">" . $nMessages . "</a> unread messages&nbsp;|";
	} else if (1 == $nMessages) {
		print "You have <a href=\"/your/messages\">" . $nMessages . "</a> unread message&nbsp;|";
	} 
?>
<a href="/your">Settings</a>&nbsp;|&nbsp;
<a href="/signout">Sign Out</a>
<? } else { ?>
<a href="/register">Register</a>&nbsp;|&nbsp;
<a href="/signin">Sign In</a>&nbsp;|&nbsp;
<?php } ?>
</td>
</tr>
<? } ?>
</table>