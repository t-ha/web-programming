<?php 
# Include the file common.php
# call the method heading
include("common.php");
heading();
?>
	<form action="matches-submit.php" method="get">
		<fieldset>
			<legend>Returning User:</legend>
			<div>
				<label>
					<strong>Name:</strong>
					<input type="text" name="name" size="16" />
				</label>
			</div>

			<div>
				<label>
					<input type="submit" value="View My Matches" />
				</label>
			</div>
		</fieldset>
	</form>

<?php
# call the method footer
footer();
?>