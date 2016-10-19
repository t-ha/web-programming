<?php 
# Include the file common.php
# call the method heading
include("common.php");
heading();
?>
	<div>
		<h1>Matches for <?= $_GET["name"] ?></h1>
	</div>

	<?php
		# grabs the file and sets it as a string
		$lines = file("singles.txt", FILE_IGNORE_NEW_LINES);

		# go through every line of the file and separate each line
		# into an array of profile characteristics
		# assuming the searched name exists in the file, set a new String as 
		# the searched name's line, client.
		foreach ($lines as $line) {
			$temp = explode(",", $line);
			if ($_GET["name"] === $temp[0]) {
				$client = explode(",", $line);
			}
		}
		
		# go through the file line by line again
		# see if the client and other users are compatible
		# if they are compatible, print out information to the page
		# otherwise, do nothing
		foreach($lines as $line) {
			$match = explode(",", $line);
			if (compatible($client, $match)){
	?>

			<div class="match">
				<p>
					<img src="https://webster.cs.washington.edu/images/nerdluv/user.jpg" alt="avatar" width="150"/>
					<?= $match[0] ?>
				</p>
				<ul>
					<li><strong>gender:</strong><?= $match[1] ?></li>
					<li><strong>age:</strong><?= $match[2] ?></li>
					<li><strong>type:</strong><?= $match[3] ?></li>
					<li><strong>OS:</strong><?= $match[4] ?></li>
				</ul>
			</div>

	<?php
			}
		}


# call the method footer
footer();

# returns true if the client and other users are combatible
# otherwise, returns false
function compatible($client, $match) {
	return gender_OS($client, $match) && personality($client, $match) && age_match($client, $match);
}
# returns true if the sexes of the searcher and the person in the
# file are opposites and if they prefer the same OS
# otherwise, returns false
function gender_OS($client, $match) {
	return $client[1] !== $match[1] && $client[4] === $match[4];
}

# returns true if both parties have at least one personality type letter in common
# otherwise, returns false
function personality($client, $match) {	
	for ($i = 0; $i < 4; $i++) {
		if (substr($client[3] , $i, 1) === substr($match[3], $i, 1)) {
			return true;
		}
	}
}

# returns true if the parties are of compatible age
# otherwise, returns false
function age_match($client, $match) {
	if ((int) $client[2] >= (int) $match[5] && (int) $client[2] <= (int) $match[6]) {
		if ((int) $match[2] >= (int) $client[5] && (int) $match[2] <= (int) $client[6]) {
			return true;
		}
	}
	return false;
}
?>


