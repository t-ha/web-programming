<!DOCTYPE html>
<html>
	<!-- This is a test page that you can use to make sure you're able to
	     perform queries in MySQL properly on the server. -->
	
	<head>
		<title>CSE 154 Database Query Test</title>
	</head>

	<body>

		<?php
		# connect to the imdb_small database
		$db = new PDO("mysql:dbname=imdb_small", "junkwan", "Qm7GwtD9j7");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		# query the database to see the movie names
		$rows = $db->query("SELECT a.first_name, a.last_name, r.role
			FROM roles r
			JOIN movies m ON r.movie_id = m.id
			JOIN actors a ON r.actor_id = a.id
			WHERE m.name = 'pi'");
		foreach ($rows as $row) {
			?>

			<p>
			<?= $row["first_name"] ?>
			<?= $row["last_name"] ?>
			<?= $row["role"] ?>
			</p>

			<?php
		}
		?>

	</body>
</html>
