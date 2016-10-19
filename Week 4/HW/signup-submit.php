<?php 
# Include the file common.php
# call the method heading
# call appendToFile
include("common.php");
heading();
appendToFile();
?>
	<div>
		<h1>Thank you!</h1>
		<p>Welcome to NerdLuv, <?= $_POST["name"] ?>!</p>
		<p>Now <a href="matches.php">log in to see your matches!</a></p>
	</div>

<?php

# call the method footer
footer();

# adds the name, sex, age, personality type, favorite OS,
# and desired age range to the file singles.txt
function appendToFile() {
	file_put_contents("singles.txt", $_POST["name"], FILE_APPEND);
	file_put_contents("singles.txt", "," . $_POST["sex"], FILE_APPEND);
	file_put_contents("singles.txt", "," . $_POST["age"], FILE_APPEND);
	file_put_contents("singles.txt", "," . $_POST["personality"], FILE_APPEND);
	file_put_contents("singles.txt", "," . $_POST["OS"], FILE_APPEND);
	file_put_contents("singles.txt", "," . $_POST["minAge"], FILE_APPEND);
	file_put_contents("singles.txt", "," . $_POST["maxAge"] . "\n", FILE_APPEND);
}
?>