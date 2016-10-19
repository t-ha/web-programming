<?php 
	# include file common.php
	# check if the user logged in
	# create the heading
	include("common.php");
	check_login();
	heading();
?>
		<div id="main">
			<h2><?= $_SESSION["name"] ?>'s To-Do List</h2>

			<ul id="todolist">

			<?php
			# if a to do list file exists for this user
			# output the correct to do list
			if (file_exists("todo_{$_SESSION["name"]}.txt")) {
				$file = file("todo_{$_SESSION["name"]}.txt", FILE_IGNORE_NEW_LINES);
				for ($i = 0; $i < count($file); $i++) {
				?>
					<li>
						<form action="submit.php" method="post">
							<input type="hidden" name="action" value="delete" />
							<input type="hidden" name="index" value="<?= $i ?>" />
							<input type="submit" value="Delete" />
						</form>
					<?= htmlentities($file[$i]); ?>
					</li>

			<?php
				}
			}
			?>
				<li>
					<form action="submit.php" method="post">
						<input type="hidden" name="action" value="add" />
						<input name="item" type="text" size="25" autofocus="autofocus" />
						<input type="submit" value="Add" />
					</form>
				</li>
			</ul>

			<div>
				<a href="logout.php"><strong>Log Out</strong></a>

				<?php 
				# if the user has ever logged in, show since when the user has been logged in
				if (isset($_COOKIE["logdate"])) {
					?>
					<em>(logged in since <?= $_COOKIE["logdate"] ?>)</em>
					
				<?php }	?>
			</div>
		</div>
<?php
	# call method footer
	footer();
?>