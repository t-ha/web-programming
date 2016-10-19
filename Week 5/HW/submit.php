<?php 
	# include file common.php
	# check if the user has ever logged in
	# creates a new to do list file for the user if on does not exist already
	include("common.php");
	check_login();
	$todofile = "todo_{$_SESSION["name"]}.txt";
	if (!file_exists($todofile)) {
		file_put_contents($todofile, "");
	}

	# if the user chose to add an item, append it to the file
	# otherwise delete the item from the file
	if ($_POST["action"] == "add") {
		file_put_contents($todofile, $_POST["item"] . "\n", FILE_APPEND);
	} else {
		# corrects the line numbers (indexes) of the items
		$file = file($todofile, FILE_IGNORE_NEW_LINES);
		for ($i = $_POST["index"]; $i < count($file) - 1; $i++) {
			$file[$i] = $file[$i + 1];
		}

		# overwrite the file with the correct indexes of the items after deletion
		file_put_contents($todofile, "");
		for ($line = 0; $line < count($file) - 1; $line++) {
			file_put_contents($todofile, $file[$line] . "\n", FILE_APPEND);
		}
	}

	# redirect back to todolist.php
	go_to_todolist();
?>