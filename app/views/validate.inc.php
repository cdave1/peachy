<?php
$url="";
$URI_QUERYSTRING = URI_QUERYSTRING();

if(isset($URI_QUERYSTRING[1])) {
	for($i=1;$i<count($URI_QUERYSTRING);$i++) {
		if (is_numeric(strpos($URI_QUERYSTRING[$i], "&"))) {
			$url .= $URI_QUERYSTRING[$i];
		} else if (is_numeric(strpos($URI_QUERYSTRING[$i], "http"))) {
			$url .= $URI_QUERYSTRING[$i] . "//";
		} else {
			$url .= $URI_QUERYSTRING[$i] . "/";
		}
		
	}
	
	
	if (false === strpos($url, "http")) {
		$url = "http://" . $url;
	}
	
	$urlArray=parse_url($url);
	$queries = false;
	$queryString = false;
	if (isset($urlArray["query"])) {
		$query=$urlArray["query"];
		$variables=explode("&",$query);
		for ($j=0;$j<count($variables);$j++){
			$queryString=explode("=",$variables[$j]);
			$queries[$j]=$queryString[0];
		}
	}

?>
<command xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<url><? echo translateURLQueryString($url); ?></url>
<? if (isset($urlArray["scheme"])) { ?><scheme><? echo $urlArray["scheme"]; ?></scheme>
<? } ?>
<? if (isset($urlArray["host"])) { ?><host><? echo $urlArray["host"]; ?></host>
<? } ?>
<? if (isset($urlArray["path"])) { ?><path><? echo $urlArray["path"]; ?></path>
<? } ?>
<? if (isset($urlArray["query"])) { ?><query>
<? if (false != $queries) { 
	foreach ($queries as $query) {
?>
<querystring><? echo $query; ?></querystring>
<? } } ?>
</query>
<? } ?>
</command>
<?php

} else {
	
?>
<command xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" />
<?
}
?>