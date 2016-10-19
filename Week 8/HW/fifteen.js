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

	// the x coordinate of the white tile, initially 3
	var eX = 3;
	// the y coordinate of the white tile, initially 3
	var eY = 3;
	// the width/height of each tile(square) in pixels
	var DIM = 100;

	// calls move for a clicked tile
	function clickMove() {
		move(this);
	}

	// calls moveValid for a clicked tile
	function clickMoveValid() {
		moveValid(this, this.offsetLeft / DIM, this.offsetTop / DIM);
	}

	// for each surrounding tile of the white tile, 
	// check to see if it a valid tile and if it can move
	// if it can move, add it to an array of valid tiles
	function getTile(neighbors) {
		for (var x = eX - 1; x <= eX + 1; x++) {
			for (var y = eY - 1; y <= eY + 1; y++) {
				if (x >= 0 && x <= 3 && y >= 0 && y <= 3) {
					var tile = document.getElementById("tile" + x + y);
					if (tile !== null) {
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

	// checks if the passed in tile can be moved
	// if it can, set canMove to true and give it a tile class
	// otherwise, set canMove to false and give it a class invalid
	function moveValid(tile, x, y) {
		if ((eX == x && (eY == y + 1 || eY == y - 1)) || 
			(eY == y && (eX == x + 1 || eX == x - 1))) {
			tile.className = "tile";
			tile.canMove = true;
		} else {
			tile.className = "invalid";
			tile.canMove = false;		
		}
	}

	// creates the beginning puzzle board
	function puzzleStart() {
		var tileNum = 1;
		var yCoord = 0;
		for(var y = 0; y >= -3; y--) {
			var xCoord = 0;
			for (var x = 0; x >= -3; x--) {
				if (tileNum < 16) {
					puzzleStartHelper(tileNum, x, y, xCoord, yCoord);
					tileNum++;
					xCoord++;
				}
			}
			yCoord++;
		}
	}

	// creates each of the 15 tiles
	// appropriately assigns each tile a classname, a number, 
	// coordinates, a part of the overall background image, and adds
	// the tile to the puzzleboard area
	// prepares each tile to be hovered or clicked
	function puzzleStartHelper(tileNum, x, y, xCoord, yCoord) {
		var tile = document.createElement("div");
		var num = document.createTextNode(tileNum);

		tile.className = "tile";
		tile.id = "tile" + xCoord + yCoord;
		tile.style.left = DIM * xCoord + "px";
		tile.style.top = DIM * yCoord + "px";
		tile.style.backgroundPosition = (x * DIM) + "px" + " " + (y * DIM) + "px";
		tile.appendChild(num);
		document.getElementById("puzzlearea").appendChild(tile);

		tile.onmousemove = clickMoveValid;
		tile.onclick = clickMove;
	}

	// randomly shuffles the tiles on the board and
	// makes sure the game is always winnable
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


