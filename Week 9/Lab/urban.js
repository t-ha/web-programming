// Timothy Ha
// 05.29.14
// CSE 154 AP
// Jiaming Li
// Lab 9

"use strict";

(function() {
	window.onload = function() {
		document.getElementById("lookup").onclick = urbanWord;
	};

	function urbanWord() {
		var term = document.getElementById("term").value;
		var ajax = new XMLHttpRequest();
		ajax.onload = show;
		ajax.open("GET", "https://webster.cs.washington.edu/cse154/labs/9/urban.php?term=" + term + "&all=true", true);
		ajax.send();
	}

	function show() {
		var ol = document.createElement("ol");
		
		var entries = this.responseXML.getElementsByTagName("entry");
		for (var i = 0; i < entries.length; i++) {
			var definition = entries[i].querySelector("definition").textContent;
			var defP = document.createElement("p");
			defP.innerHTML = definition;

			var ex = entries[i].querySelector("example").textContent;
			var exP = document.createElement("p");
			exP.className = "example";
			exP.innerHTML = ex;

			var aP = document.createElement("p");
			aP.innerHTML = "-" + entries[i].getAttribute("author");

			var li = document.createElement("li");
			li.appendChild(defP);
			li.appendChild(exP);
			li.appendChild(aP);
			ol.appendChild(li);
		}
		var result = document.getElementById("result");
		result.appendChild(ol);
		
	}
})();