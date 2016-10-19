<?php 
# Include the file common.php
# call the method heading
include("common.php");
heading();
?>

		<form action="signup-submit.php" method="post">
			<fieldset>
				<legend>New User Signup:</legend>
				<div>
					<label>
						<strong>Name:</strong>
						<input type="text" name="name" size="16" />
					</label>
				</div>

				<div>
					<strong>Gender:</strong>
					<input type="radio" name="sex" value="M" /> Male
					<input type="radio" name="sex" value="F" checked="checked" /> Female
				</div>

				<div>
					<label>
						<strong>Age:</strong>
						<input type="text" name="age" maxlength="2" size="6" />
					</label>
				</div>

				<div>
					<label>
						<strong>Personality type:</strong>
						<input type="text" name="personality" maxlength="4" size="6" />
						(<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">Don't know your type?</a>)
					</label>
				</div>

				<div>
					<label>
						<strong>Favorite OS:</strong>
						<select name="OS">
							<option value="Windows" selected="selected">Windows</option>
							<option value="Mac OS X">Mac OS X</option>
							<option value="Linux">Linux</option>
						</select>
					</label>
				</div>

				<div>
					<strong>Seeking age:</strong>
					<input type="text" name="minAge" placeholder="min" maxlength="2" size="6" />
					to
					<input type="text" name="maxAge" placeholder="max" maxlength="2" size="6" />
				</div>

				<div>
					<label>
						<input type="submit" value="Sign Up" />
					</label>
				</div>
			</fieldset>
		</form>
<?php
# call the method footer
footer();
?>




