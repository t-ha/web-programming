<?php
	# include the file common.php
	# start session
	include("common.php");
	session_start();

	# if either username or password are not set
	# redirect to start.php with a parameter of fail
	# (otherwise) continue with the login process
	if (!isset($_POST["name"]) || !isset($_POST["password"])) {
		header("Location: start.php?fail=true");
		die();
	} else {
		$name = $_POST["name"];
		$pass = $_POST["password"];
		
		# based on assumption there is an empty users.txt file to start with
		# before any accounts are created, messageboard said this was okay to assume.
		# if the entered username exists and the password matches, set the session variables
		# and redirect to todolist.php
		# if the password does not match redirect to start.php
		# if the entered username does not exist proceed to account creation
		$lines = file("users.txt", FILE_IGNORE_NEW_LINES);
		foreach ($lines as $line) {
			$account = explode(":", $line, 2);
			if ($account[0] == $name) {
				if ($account[1] != $pass) {
					go_to_start();
				} else {
					set_to_do($name, $pass);
				}
			}
		}

		# check to see if the username and password are valid entries for
		# creating a new account
		$userMatch = preg_match("/^[a-z][a-z0-9]{2,7}$/", $name);
		$passMatch = preg_match("/^\d.{4,10}[^a-zA-Z0-9]$/", $pass);

		# if both are valid, add the account to the file and set session variables and
		# redirect to todolist.php
		# otherwise, redirect to start.php
		if ($userMatch && $passMatch) {
			$temp_string = $name . ":" . $pass . "\n";
			file_put_contents("users.txt", $temp_string, FILE_APPEND);
			set_to_do($name, $pass);
		} else {
			go_to_start();
		}
	}

# starts a session, and stores session data
# sets a cookie to the last login time
# redirect to todolist.php
function set_to_do($name, $pass) {
	$_SESSION["name"] = $name;
	$_SESSION["password"] = $pass;
	date_default_timezone_set('America/Los_Angeles');
	setcookie("logdate", date("D Y M d, g:i:s a"), time() + 60 * 60 * 24 * 7);
	go_to_todolist();
}
?>