// CSE 154
// Creates and manipulates rectangles. 

"use strict";

(function() {
	window.onload = function() {
		var colorButton = document.getElementById("color");
		colorButton.onclick = colorIt;

		var moveButton = document.getElementById("move");
		moveButton.onclick = moveIt;

		createRects();
		moveIt();
	}

	// Dynamically create rectangles on the page
	function createRects() {
		for(var i = 0; i < 50; i++) {
			var rect = document.createElement("div");
			rect.className = "rectangle";
			rect.onclick = removeRect;
			document.getElementById("rectanglearea").appendChild(rect);
		}
	}

	// Randomly color all of the rectangles
	function colorIt() {
		var rects = document.querySelectorAll("#rectanglearea .rectangle");
		for(var i = 0; i < rects.length; i++) {
			var r = Math.floor(Math.random() * 256);
			var g = Math.floor(Math.random() * 256);
			var b = Math.floor(Math.random() * 256);
			rects[i].style.backgroundColor = "rgb(" + r + ", " + g + ", " + b + ")";
		}
	}

	// Randomly position all the rectangles
	function moveIt() {
		var rects = document.querySelectorAll("#rectanglearea .rectangle");
		for(var i = 0; i < rects.length; i++) {
			rects[i].style.position = "absolute";
			rects[i].style.top = Math.floor(Math.random() * 451) + "px";
			rects[i].style.left = Math.floor(Math.random() * 651) + "px";
		}
	}

	// Remove clicked rectangle
	function removeRect() {
		this.parentNode.removeChild(this);
	}
})();