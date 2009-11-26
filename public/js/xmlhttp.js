function getHTTPObject() {
  var xmlhttp;
  /*@cc_on
  @if (@_jscript_version >= 5)
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (E) {
        xmlhttp = false;
      }
    }
  @else
  xmlhttp = false;
  @end @*/
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
    try {
      xmlhttp = new XMLHttpRequest();
    } catch (e) {
      xmlhttp = false;
    }
  }
  return xmlhttp;
}
var http = getHTTPObject(); 

function validateURL() {
	if (http.readyState == 4) {
		var xmlDocument = http.responseXML; 
		var text = "";
		if (!xmlDocument.getElementsByTagName('command').item(0).hasChildNodes()) {
			setVisibleLayer("commandUrlElements", "none")
		} else {
			var url = xmlDocument.getElementsByTagName('url').item(0).firstChild.data;
			var scheme = xmlDocument.getElementsByTagName('scheme').item(0).firstChild.data;
			var host = xmlDocument.getElementsByTagName('host').item(0).firstChild.data;
			var path = xmlDocument.getElementsByTagName('path').item(0).firstChild.data;
			var query = ""; // xmlDocument.getElementsByTagName('query').item(0).firstChild.data;
			text += '<div id="urlData"><b>Clean URL:</b> ' + url + '</div>';
			text += '<div id="urlData"><b>Scheme:</b> ' + scheme + '</div>';
			text += '<div id="urlData"><b>Host:</b> ' + host + '</div>';
			text += '<div id="urlData"><b>Path:</b> ' + path + '</div>';
			text += '<div id="urlData"><b>Query:</b> ' + query + '</div>';
			setVisibleLayer("commandUrlElements", "block")
			WriteLayer("commandUrlElements",null,text,false);
		}
		isWorking = false;
	}
}

function getCommand() {
	if (http.readyState == 4) {
		var xmlDocument = http.responseXML; 
		var command = xmlDocument.getElementsByTagName('command').item(0).firstChild.data;
		isWorking = false;
	}
}

function parseURL(inputField)
{
	url="/validate/" + document.getElementById(inputField).value;
	http.open("GET",url,true);
	http.onreadystatechange=validateURL
	http.setRequestHeader('Accept','message/x-jl-formresult')
	isWorking = true;
	http.send(null);
	return false;
}
var isWorking = false;

function testCommand(inputField)
{
	var command = document.getElementById(inputField).value;
	location.href = "/exec/" + command;
	return false;
}