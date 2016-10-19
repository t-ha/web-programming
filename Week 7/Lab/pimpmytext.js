"user strict";

var timer = null;

function alertme() {
	var text = document.getElementById("textbox");
	// timer = setInterval(upFont, 500)
	upFont();

	if (checkBling.checked) {
		text.style.fontWeight = "bold";
		text.style.color = "green";
		text.style.textDecoration = "underline";
		text.style.textDecoration = "line-through"
		text.value = text.value.toUpperCase();
		
	} else {
		// clearInterval(timer);
		// timer = null;
		text.style.fontWeight = "normal";
		text.style.color = "black";
		text.style.textDecoration = "none"
	}
}

function snoop() {
	var text = document.getElementById("textbox");
	var str = text.value;
	var parts = str.split("\n");
	text.value = parts.join("-izzle\n")
}

function upFont() {
	var fSize = parseInt(text.style.fontSize);
	fSize = fSize + 1 + "pt";
	text.style.fontSize = fSize;
	if (text.style.fontSize == "") {
		text.style.fontSize == "12pt";
	}
	text.style.fontSize = parseInt(text.style.fontSize) + 2 + "pt";
}