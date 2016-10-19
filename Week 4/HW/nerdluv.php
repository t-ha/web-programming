<?php 
# Include the file common.php
# call the method heading
include("common.php");
heading();
?>
		<div>
			<h1>Welcome!</h1>

			<ul>
				<li>
					<a href="signup.php">
						<img src="https://webster.cs.washington.edu/images/nerdluv/signup.gif" alt="icon" />
						Sign up for a new account
					</a>
				</li>

				<li>
					<a href="matches.php">
						<img src="https://webster.cs.washington.edu/images/nerdluv/heartbig.gif" alt="icon" />
						Check your matches
					</a>
				</li>
			</ul>
		</div>
<?php
# call the method footer
footer();
?>