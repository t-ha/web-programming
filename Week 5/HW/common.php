<?php
// Timothy Ha
// 05.07.14
// CSE 154 AP
// Jiaming Li
// Assignment #5: To-Do List

# adds the page title as well as any css links and favorite icon
# also adds the main header
function heading() {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Remember the Cow</title>
		<link href="https://webster.cs.washington.edu/css/cow-provided.css" type="text/css" rel="stylesheet" />
		<link href="cow.css" type="text/css" rel="stylesheet" />
		<link href="https://webster.cs.washington.edu/images/todolist/favicon.ico" type="image/ico" rel="shortcut icon" />
	</head>

	<body>
		<div class="headfoot">
			<h1>
				<img src="https://webster.cs.washington.edu/images/todolist/logo.gif" alt="logo" />
				Remember<br />the Cow
			</h1>
		</div>

<?php
}

# creates the ending with a quote and copyright information
# creates links to validate html and css
function footer() {
?>
		<div class="headfoot">
			<p>
				"Remember The Cow is nice, but it's a total copy of another site." - PCWorld<br />
				All pages and content &copy; Copyright CowPie Inc.
			</p>

			<div id="w3c">
				<a href="https://webster.cs.washington.edu/validate-html.php">
					<img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML" /></a>
				<a href="https://webster.cs.washington.edu/validate-css.php">
					<img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>
		</div>
	</body>
</html>

<?php
}

# redirects to start.php and exits the current script
function go_to_start() {
	header("Location: start.php");
	die();
}

# redirects to todolist.php and exits the current script
function go_to_todolist() {
	header("Location: todolist.php");
	die();
}

# checks if the user has ever logged in
# if not, redirect to start.php
function check_login() {
	session_start();
	if (!isset($_SESSION["name"])) {
		go_to_start();
	}
}
?>