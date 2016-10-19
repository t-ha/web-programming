<?php
	// include common.php file
	// call heading function
	// get the name of the actors from the get paremeter
	include("common.php");
	heading();
	$firstName = $_GET["firstname"];
	$lastName = $_GET["lastname"];
?>
	<h1><?= $firstName ?> <?= $lastName ?> and Kevin Bacon</h1>

	<?php
	// links to the database
	$db = new PDO("mysql:dbname=imdb", "junkwan", "Qm7GwtD9j7");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// calls findactor and sets the returned value to variable actor
	$actor = findactor($db, $firstName, $lastName);

	// if the actor is found, go through a second query to find all the 
	// films the actor has been in 
	if ($actor->rowCount() > 0) {
		$actorID = $actor->fetch();
		$matched_films = query_films($db, $actorID);

		// if there is at least one film starring both the actor and Kevin Bacon
		// create the table of films
		if ($matched_films->rowCount() > 0) {
			film_table("Films with $firstName $lastName and Kevin Bacon",$matched_films);
		} else {
			// otherwise, throw an error message
			?>
			<p><?= $firstName ?> <?= $lastName ?> wasn't in any films with Kevin Bacon.</p>
			<?php
		}
	} else {
		// if the actor is not found, throw an error message
		?>
		<p>Actor <?= $firstName ?> <?= $lastName ?> not found</p>
		<?php
	}

	// call footer function
	footer();

	// query. find all the films by name and year starring both the actor and Kevin Bacon
	// and return them by year descending
	function query_films($db, $actorID) {
		return $db->query("SELECT m.name, m.year 
			FROM movies m
			JOIN roles r ON m.id = r.movie_id
			JOIN roles r1 ON m.id = r1.movie_id
			JOIN actors a ON r.actor_id = a.id
			JOIN actors k ON r1.actor_id = k.id
			WHERE a.id = '$actorID[0]'
			AND k.first_name = 'Kevin'
			AND k.last_name = 'Bacon'
			ORDER BY m.year DESC");
	}
?>