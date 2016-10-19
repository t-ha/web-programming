<?php
	# start a session and include the file common.php
	# check to see if a session for name name is set and if it is
	# redirect to todolist.php
	# create the heading
	session_start();
	include("common.php");
	if (isset($_SESSION["name"])) {
		go_to_todolist();
	}
	heading();
?>

		<div id="main">
			<p>
				The best way to manage your tasks. <br />
				Never forget the cow (or anything else) again!
			</p>

			<p>
				Log in now to manage your to-do list. <br />
				If you do not have an account, one will be created for you.
			</p>

			<?php
			# if parameter fail is set, show the error message
			if(isset($_GET["fail"])) {
				?>
				<p id="startError">ERROR: Please enter username and password.</p>

			<?php } ?>

			<form id="loginform" action="login.php" method="post">
				<div><input name="name" type="text" size="8" autofocus="autofocus" /> <strong>User Name</strong></div>
				<div><input name="password" type="password" size="8" /> <strong>Password</strong></div>
				<div><input type="submit" value="Log in" /></div>
			</form>

			<?php
			# if the user has ever logged in show the last login date
			if (isset($_COOKIE["logdate"])) {
				?>
				<p>
					<em>(last login from this computer was <?= $_COOKIE["logdate"] ?>)</em>
				</p>
			<?php } ?>
		</div>
<?php
	# calls footer method
	footer();
?>