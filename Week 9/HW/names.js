// Timothy Ha
// 06.04.14
// CSE 154 AP
// Jiaming Li
// Assignment #9: Baby Names

(function() {
	"use strict";
	window.onload = function() {
		// retrieve the list of names to search through
		runQueries(getNames, "list");
		document.getElementById("search").onclick = getSearch;
	};

	// clears all html in the divs
	function clearAll() {
		document.getElementById("errors").innerHTML = "";
		document.getElementById("meaning").innerHTML = "";
		document.getElementById("graph").innerHTML = "";
		document.getElementById("celebs").innerHTML = "";
	}

	// when there is an error, cancel all the loading
	function errorHandler(page) {
		loadingAll("done", false);
		var error = document.createElement("pre");
		error.className = "error";
		error.innerHTML = "Error making request:" +
				"\n\nServer status: \n" + page.status + " " + page.statusText +
		 		"\n\nServer response text:\n" + page.responseText;
		document.getElementById("loadingnames").className = "doneloading";			 		
		document.getElementById("errors").appendChild(error);
	}

	// outputs to the page a list of celebrities who share the same first name
	// as the searched name
	function getCelebs() {
		var data = JSON.parse(this.responseText);
		var celebData = document.getElementById("celebs");
		celebData.innerHTMl = "";
		for (var i = 0; i < data.actors.length; i++) {
			var celebLI = document.createElement("li");
			celebLI.innerHTML = data.actors[i].firstName + " " + data.actors[i].lastName + " (" +
				data.actors[i].filmCount + " films)";
			celebData.appendChild(celebLI);
		}
		loadingOff("celebs");
	}

	// uses ajax to retrieve data for specific GET with parameters
	function runQueries(method, types) {
		var ajax = new XMLHttpRequest();
		ajax.onload = method;
		ajax.onerror = errorHandler;
		ajax.open("GET", "https://webster.cs.washington.edu/cse154/babynames.php?type=" + types, true);
		ajax.send();
	}
	
	// activated when the search button is clicked
	// when clicked, display the meaning, rankings, and celebrities who share the same
	// name if all available
	function getSearch() {
		var name = document.getElementById("allnames").value;
		var gender;
		if (document.getElementById("genderm").checked) {
			gender = "m";
		} else {
			gender = "f";
		}

		if (name) {
			var result = document.getElementById("resultsarea");
			result.style.display = "block";
			loadingAll("", true);
			runQueries(getMeaning, "meaning&name=" + name);
			runQueries(getRanking, "rank&name=" + name + "&gender=" + gender);
			runQueries(getCelebs, "celebs&name=" + name + "&gender=" + gender);
		}
	}

	// if there is no error, get the meaning of the name and output it
	// onto the page
	function getMeaning() {
		if (this.status == 200) {
			document.getElementById("meaning").innerHTML = this.responseText;
			loadingOff("meaning");
		} else {
			errorHandler(this);
		}
		
	}

	// if there is no error, retrieve the list of names available to search
	// enable the drop down list of names
	function getNames() {
		if (this.status == 200) {
			var names = this.responseText.split("\n");
			var allnames = document.getElementById("allnames");
			for (var i = 0; i < names.length; i++) {
				var nameOption = document.createElement("option");
				nameOption.value = names[i];
				nameOption.innerHTML = names[i];
				allnames.appendChild(nameOption);
			}
			allnames.disabled = false;
			loadingOff("names");
		} else if (this.status !== 400) {
			errorHandler(this);
		}
	}

	// if there is no error, get popularity data for the name, if available,
	// and display it on the page by year in bar graph format
	function getRanking() {
		if (this.status == 200) {
			var graph = document.getElementById("graph");
			var ranks = this.responseXML.querySelectorAll("rank");
			var yearHeaders = document.createElement("tr");

			// display the years
			for (var i = 0; i < ranks.length; i++) {
				var year = document.createElement("th");
				year.innerHTML = ranks[i].getAttribute("year");
				yearHeaders.appendChild(year);
			}

			graph.appendChild(yearHeaders);

			// display the bar graph for popularity of the name
			var years = document.createElement("tr");
			for (var i = 0; i < ranks.length; i++) {
				var yearBar = document.createElement("div");
				var ranking = parseInt(ranks[i].textContent, 10);
				rankStyle(yearBar, ranking);

				var yearTD = document.createElement("td");
				yearTD.appendChild(yearBar);
				years.appendChild(yearTD);
			}

			graph.appendChild(years);
		} else {
			document.getElementById("norankdata").style.display = "block";
		}

		loadingOff("graph");
	}

	// disables the loading gif of a specific div
	function loadingOff(id) {
		document.getElementById("loading" + id).className = "doneloading";	
	}

	// "refreshes" the page by clearing HTML and 
	// setting loading gifs
	function loadingAll(type, clear) {
		if (clear) {
			clearAll();
		}
		document.getElementById("loadingmeaning").className = type + "loading";
		document.getElementById("norankdata").style.display = "none";
		document.getElementById("loadinggraph").className = type + "loading";
		document.getElementById("loadingcelebs").className = type + "loading";
	}

	// styles the ranking bar heights and text color if need be
	function rankStyle(yearBar, ranking) {
		yearBar.className = "rankingBar";
		if (ranking >= 1 && ranking <= 10) {
			yearBar.classList.add("topRank");
		}

		var barHeight;
		if (ranking) {
			barHeight = parseInt((1000 - ranking) / 4, 10);
		} else {
			barHeight = 0;
		}
		yearBar.style.height = barHeight + "px";
		yearBar.innerHTML = ranking;
	}
})();








