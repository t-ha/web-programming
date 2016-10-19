<?php
	// include common.php file
	// call heading function
	// get the searched actor's name from the get parameter
	include("common.php");
	heading();
	$firstName = $_GET["firstname"];
	$lastName = $_GET["lastname"];
?>
	<h1>Results for <?= $firstName ?> <?= $lastName ?></h1>

	<?php
	// links to the database
	$db = new PDO("mysql:dbname=imdb", "junkwan", "Qm7GwtD9j7");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// calls findactor method and sets the return value to variable actor
	$actor = findactor($db, $firstName, $lastName);

	// if the actor is found, go through a second query to find all the 
	// films the actor has been in 
	if ($actor->rowCount() > 0) {
	 	$actorID = $actor->fetch();
		$matched_films = query_films($db, $actorID);

		// create the film table
		film_table("All Films", $matched_films);
	} else {
		// if the actor is not found, throw an error
		?>
		<p>Actor <?= $firstName ?> <?= $lastName ?> not found</p>
	<?php
	}
	//call the footer method
	footer();

	// returns all the name and years of films
	// the actor has been in by year descending
	function query_films($db, $actorID) {
		return $db->query("SELECT m.name, m.year 
			FROM movies m
			JOIN roles r ON m.id = r.movie_id
			JOIN actors a ON r.actor_id = a.id
			WHERE a.id = '$actorID[0]'
			ORDER BY m.year DESC");
	}
?>