// Timothy Ha
// 05.28.14
// CSE 154 AP
// Jiaming Li
// Assignment #8: Fifteen Puzzle

"use strict";

(function() {
	window.onload = function() {
		// onload: call puzzleStart function
		// if the shufflebutton is clicked, call shuffle function
		puzzleStart();
		document.getElementById("shufflebutton").onclick = shuffle;
	};

	// the x coordinate of the white square
	var eX = 3;
	// the y coordinate of the white square
	var eY = 3;
	// the width of each square in pixels
	var DIM = 100;

	// calls the move function with this as parameter
	function clickMove() {
		move(this);
	}

	function clickMoveValid() {
		moveValid(this, this.offsetLeft / DIM, this.offsetTop / DIM);
	}

	// 
	function getTile(neighbors) {
		// for (var x = eX - 1; x <= eX + 1; x++) {
		// 	for (var y = eY - 1; y <= eY + 1; y++) {
		// 		if (((eX == x) && ((eY + 1) == y || (eY - 1) == y)) || 
		// 			 ((eY == y) && ((eX + 1) == x || (eX - 1) == x))) {
		// 			if (x >= 0 && x <= 3 && y >= 0 && y <= 3) {
		// 				document.getElementById("tile" + x + y).canMove = true;
		// 				neighbors.push(document.getElementById("tile" + x + y));
		// 			}
		// 		}
		// 	}
		// }
		for (var x = eX - 1; x <= eX + 1; x++) {
			for (var y = eY - 1; y <= eY + 1; y++) {
				if (x >= 0 && x <= 3 && y >= 0 && y <= 3) {
					var tile = document.getElementById("tile" + x + y);
					if (tile != null) {
						moveValid(tile, x, y);
						if (tile.canMove) {
							neighbors.push(tile);
						}
					}
				}
			}
		}
	}
	
	// moves the passed in tile to its new coordinates
	// and moves the empty white square in its place
	function move(tile) {
		if (tile.canMove) {
			var newX = eX;
			var newY = eY;
			eX = tile.offsetLeft / DIM;
			eY = tile.offsetTop / DIM;
			tile.id = "tile" + newX + newY;
			tile.style.left = (newX * DIM) + "px";
			tile.style.top = (newY * DIM) + "px";
		}
	}

	function moveValid(tile, x, y) {
		// var x = this.offsetLeft / DIM;
		// var y = this.offsetTop / DIM;
		// if ((eX == x && (eY == y + 1 || eY == y - 1)) || 
		// 	(eY == y && (eX == x + 1 || eX == x - 1))) {
		// 	this.className = "tile";
		// 	this.canMove = true;
		// } else {
		// 	this.className = "noMove";
		// 	this.canMove = false;		
		// }
		// var x = tile.offsetLeft / DIM;
		// var y = tile.offsetTop / DIM;
		if ((eX == x && (eY == y + 1 || eY == y - 1)) || 
			(eY == y && (eX == x + 1 || eX == x - 1))) {
			tile.className = "tile";
			tile.canMove = true;
		} else {
			tile.className = "noMove";
			tile.canMove = false;		
		}
	}

	function puzzleStart() {
		var tileNum = 1;
		var xCoord;
		var yCoord = 0;
		for(var y = 0; y >= -3; y--) {
			xCoord = 0;
			for (var x = 0; x >= -3; x--) {
				if (tileNum < 16) {
					var tile = document.createElement("div");
					var num = document.createTextNode(tileNum);
					tile.className = "tile";
					tile.id = "tile" + xCoord + yCoord;
					tile.style.left = DIM * xCoord + "px";
					tile.style.top = DIM * yCoord + "px";
					tile.style.backgroundPosition = (x * DIM) + "px" + " " + (y * DIM) + "px";
					tile.appendChild(num);
					tile.onmousemove = clickMoveValid;
					tile.onclick = clickMove;
					document.getElementById("puzzlearea").appendChild(tile);
					tileNum++;
					xCoord++;
				}
			}
			yCoord++;
		}
	}

	// randomly shuffles the tiles on the board and
	// the game is always winnable
	function shuffle() {
		var neighbors;
		for (var i = 0; i < 1000; i++) {
			neighbors = [];
			getTile(neighbors);
			var rand = parseInt(Math.random() * neighbors.length, 10);
			move(neighbors[rand]);		
		}
	}
})();


