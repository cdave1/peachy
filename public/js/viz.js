function addOption() {
	var command = parseInt(document.getElementById('nOptionField').value,16);
	var text = "";
	var optionField = document.createElement('div');
	optionField.id = "optionField" + command;
	optionField.setAttribute('class','fade-6092BF');
	text += "<table border='0' cellpadding='3' cellspacing='0'>";
	text += "<tr><td valign='middle'>";
	text += "<b>Switch:</b>";
	text += "</td><td valign='middle'>";
	text += "<input type='text' id='strixOption" + command + "' name='strixOptions[]' size='10' onBlur='parseURL(\"urlDirective" + command + "\")'>";
	text += "</td></tr>";
	text += "<tr><td valign='middle'>";
	text += "<b>Full URL:</b>";
	text += "</td><td valign='middle'>";
	text += "<input type='text' id='urlDirective" + command + "' name='urlDirectives[]' size='65' onBlur='parseURL(\"urlDirective" + command + "\")'><br />";
	text += "<div id='note'>";
	text += "<small>&quot;http://&quot; will be added to the begininning of the url if it is not specified.</small>";
	text += "</div>";
	text += "</td></tr>";
	text += "<tr><td valign='middle'>";
	text += "<b>Description:</b>";
	text += "</td><td valign='middle'>";
	text += "<input type='text' id='strDescription" + command + "' name='strDescriptions[]' size='50' onBlur='parseURL(\"urlDirective" + command + "\")'>";
	text += "</td></tr>";
	text += "</table>";
	text += "<a href='#' onClick='removeOption(\"optionField" + command + "\");'>Remove</a>";
	text += "<hr />";
	optionField.innerHTML = text;
	var options = document.getElementById("options");
	options.parentNode.insertBefore(optionField, options);
	
	document.getElementById('nOptionField').value = (command + 1); // Only concerned that new options are unique
	Fat.fade_element("optionField" + command, 30, 1000, '#6092BE', '#FFFFFF');
	return false;
}

function removeOption(optionFieldID)
{
	var options = document.getElementById("options");
	var optionField = document.getElementById(optionFieldID);
	
	optionField.parentNode.removeChild(optionField);
	
	var command = parseInt(document.getElementById('nOptionField').value,16);
	document.getElementById('nOptionField').value = (command + 1);// Only concerned that new options are unique
}

function WriteLayer(ID,parentID,sText,allowConcatenate) { 
	if (document.layers) { 
		var oLayer; 
		if(parentID){ 
			oLayer = eval('document.' + parentID + '.document.' + ID + '.document'); 
		} else { 
			oLayer = document.layers[ID].document; 
		} 
		oLayer.open(); 
		oLayer.write(sText); 
		oLayer.close(); 
	} else if (parseInt(navigator.appVersion)>=5&&navigator.appName=="Netscape") {
		if (allowConcatenate) {
   			document.getElementById(ID).innerHTML += sText;
   		} else {
   			document.getElementById(ID).innerHTML = sText;
   		}
 	} else if (document.all) {
 		if (allowConcatenate) {
 			document.all[ID].innerHTML += sText 
 		} else {
 			document.all[ID].innerHTML = sText 
 		}
 	}
}

function go()
{
	box = document.jumpto.navi;
	destination = box.options[box.selectedIndex].value;
	if (destination) location.href = destination;
}

function email_go()
{
	box = document.emailMode.navi;
	destination = box.options[box.selectedIndex].value;
	if (destination) location.href = destination;
}

function toggleLayer(whichLayer)
{
	if (document.getElementById)
	{
		// this is the way the standards work
		var style2 = document.getElementById(whichLayer).style;
		style2.display = style2.display? "":"block";
	}
	else if (document.all)
	{
		// this is the way old msie versions work
		var style2 = document.all[whichLayer].style;
		style2.display = style2.display? "":"block";
	}
	else if (document.layers)
	{
		// this is the way nn4 works
		var style2 = document.layers[whichLayer].style;
		style2.display = style2.display? "":"block";
	}
}

function setVisibleLayer(whichLayer, visible)
{
	if (document.getElementById)
	{
		// this is the way the standards work
		var style2 = document.getElementById(whichLayer).style;
		style2.display = visible;
	}
	else if (document.all)
	{
		// this is the way old msie versions work
		var style2 = document.all[whichLayer].style;
		style2.display = visible;
	}
	else if (document.layers)
	{
		// this is the way nn4 works
		var style2 = document.layers[whichLayer].style;
		style2.display = visible;
	}
}

// @name      The Fade Anything Technique
// @namespace http://www.axentric.com/aside/fat/
// @version   1.0-RC1
// @author    Adam Michela

var Fat = {
	make_hex : function (r,g,b) 
	{
		r = r.toString(16); if (r.length == 1) r = '0' + r;
		g = g.toString(16); if (g.length == 1) g = '0' + g;
		b = b.toString(16); if (b.length == 1) b = '0' + b;
		return "#" + r + g + b;
	},
	fade_all : function ()
	{
		var a = document.getElementsByTagName("*");
		for (var i = 0; i < a.length; i++) 
		{
			var o = a[i];
			var r = /fade-?(\w{3,6})?/.exec(o.className);
			if (r)
			{
				if (!r[1]) r[1] = "";
				if (o.id) Fat.fade_element(o.id,null,null,"#"+r[1]);
			}
		}
	},
	fade_element : function (id, fps, duration, from, to) 
	{
		if (!fps) fps = 30;
		if (!duration) duration = 3000;
		if (!from || from=="#") from = "#FFFFFF";
		if (!to) to = this.get_bgcolor(id);
		
		var frames = Math.round(fps * (duration / 1000));
		var interval = duration / frames;
		var delay = interval;
		var frame = 0;
		
		if (from.length < 7) from += from.substr(1,3);
		if (to.length < 7) to += to.substr(1,3);
		
		var rf = parseInt(from.substr(1,2),16);
		var gf = parseInt(from.substr(3,2),16);
		var bf = parseInt(from.substr(5,2),16);
		var rt = parseInt(to.substr(1,2),16);
		var gt = parseInt(to.substr(3,2),16);
		var bt = parseInt(to.substr(5,2),16);
		
		var r,g,b,h;
		while (frame < frames)
		{
			r = Math.floor(rf * ((frames-frame)/frames) + rt * (frame/frames));
			g = Math.floor(gf * ((frames-frame)/frames) + gt * (frame/frames));
			b = Math.floor(bf * ((frames-frame)/frames) + bt * (frame/frames));
			h = this.make_hex(r,g,b);
		
			setTimeout("Fat.set_bgcolor('"+id+"','"+h+"')", delay);

			frame++;
			delay = interval * frame; 
		}
		setTimeout("Fat.set_bgcolor('"+id+"','"+to+"')", delay);
	},
	set_bgcolor : function (id, c)
	{
		var o = document.getElementById(id);
		o.style.backgroundColor = c;
	},
	get_bgcolor : function (id)
	{
		var o = document.getElementById(id);
		while(o)
		{
			var c;
			if (window.getComputedStyle) c = window.getComputedStyle(o,null).getPropertyValue("background-color");
			if (o.currentStyle) c = o.currentStyle.backgroundColor;
			if ((c != "" && c != "transparent") || o.tagName == "BODY") { break; }
			o = o.parentNode;
		}
		if (c == undefined || c == "" || c == "transparent") c = "#FFFFFF";
		var rgb = c.match(/rgb\s*\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*\)/);
		if (rgb) c = this.make_hex(parseInt(rgb[1]),parseInt(rgb[2]),parseInt(rgb[3]));
		return c;
	}
}

window.onload = function () 
{
	Fat.fade_all();
}