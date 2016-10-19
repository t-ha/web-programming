<?php
// Timothy Ha
// 05.14.14
// CSE 154 AP
// Jiaming Li
// Assignment #6: Kevin Bacon

// adds the title, css link and top IMDB banner
function heading() {
?>
<!DOCTYPE html>
<html>
	<head>
		<title>My Movie Database (MyMDb)</title>
		<meta charset="utf-8" />
		<link href="https://webster.cs.washington.edu/images/kevinbacon/favicon.png" type="image/png" rel="shortcut icon" />
		<link href="bacon.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="frame">
			<div class="banner">
				<a href="mymdb.php"><img src="https://webster.cs.washington.edu/images/kevinbacon/mymdb.png" alt="banner logo" /></a>
				My Movie Database
			</div>

			<div id="main">
<?php
}

// adds the search forms and the bottom banner with the
// the html and css validation
function footer() {
?>
				<div id="searchform">
					<form action="search-all.php" method="get">
						<fieldset>
							<legend>All movies</legend>
							<div>
								<input name="firstname" type="text" size="12" placeholder="first name" autofocus="autofocus" /> 
								<input name="lastname" type="text" size="12" placeholder="last name" /> 
								<input type="submit" value="go" />
							</div>
						</fieldset>
					</form>

					<!-- form to search for movies where a given actor was with Kevin Bacon -->
					<form action="search-kevin.php" method="get">
						<fieldset>
							<legend>Movies with Kevin Bacon</legend>
							<div>
								<input name="firstname" type="text" size="12" placeholder="first name" /> 
								<input name="lastname" type="text" size="12" placeholder="last name" /> 
								<input type="submit" value="go" />
							</div>
						</fieldset>
					</form>
				</div>
			</div> <!-- end of #main div -->
		
			<div class="banner">
				<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a>
				<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>
		</div> <!-- end of #frame div -->
	</body>
</html>
<?php
}

// runs query to find the searched actor if he/she exists
// and returns the actor id
function findactor($db, $firstName, $lastName) {
	$firstName = $db->quote($firstName . "%");
	$lastName = $db->quote($lastName);
	return $db->query("SELECT id 
				FROM actors 
				WHERE first_name LIKE $firstName
				AND last_name = $lastName
				ORDER BY film_count DESC 
				LIMIT 1");
}

// creates the table of list of films for the actor
// or the films the actor and Kevin Bacon have in common
function film_table($tCaption, $films) {
?>
	<table>
		<caption><?= $tCaption ?></caption>
		<tr><th>#</th><th>Title</th><th>Year</th></tr>
		<?php
		$i = 1;
		foreach ($films as $film) {
			?>
			<tr><td><?= $i ?></td><td><?= $film["name"] ?></td><td><?= $film["year"] ?></td></tr>
			<?php
			$i++;
		}
		?>
	</table>
<?php
}
?>
