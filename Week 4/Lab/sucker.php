<!DOCTYPE html>
<html>
	<head>
		<title>Buy Your Way to a Better Education!</title>
		<link href="https://www.cs.washington.edu/education/courses/cse154/14sp/labs/4/buyagrade.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<?php
			if (isPassed() && notEmpty()) {
				if(validCC() && luhn()) {
		?>
					<h1>Thanks, sucker!</h1>

					<p>Your information has been recorded.</p>

					<div>
						<strong>Name</strong>
						<?= $_POST["name"]; ?>
					</div>

					<div>
						<strong>Section</strong>
						<?= $_POST["section"]; ?>
					</div>

					<div>
						<strong>Credit Card Type</strong>
						<?= $_POST["CC"]; ?>
					</div>

					<div>
						<strong>Credit Card Number</strong>
						<?= $_POST["CCnumber"]; ?>
					</div>
					<?= addSuckers(); ?>
					<p> Here are all the suckers who have submitted here:</p>
<pre>
<?php include("suckers.txt"); ?>
</pre>

		<?php
			} else {
		?>
			<h1>Sorry</h1>
			<p>You didn't provide a valid card number. <a href="buyagrade.html">Try again?</a></p>
		<?php
			}
		} else {
		?>
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. <a href="buyagrade.html">Try again?</a></p>
		<?php
		}
		?>
	</body>
</html>  

<?php
	function addSuckers() {
		file_put_contents("suckers.txt", $_POST["name"], FILE_APPEND);
		file_put_contents("suckers.txt", ";" . $_POST["section"], FILE_APPEND);
		file_put_contents("suckers.txt", ";" . $_POST["CC"], FILE_APPEND);
		file_put_contents("suckers.txt", ";" . $_POST["CCnumber"], FILE_APPEND);
		file_put_contents("suckers.txt", "\r\n", FILE_APPEND);
	}

	function isPassed() {
		return isset($_POST["name"]) && isset($_POST["section"]) && isset($_POST["CC"]) && isset($_POST["CCnumber"]);
	}

	function notEmpty() {
		return !empty($_POST["name"]) && !empty($_POST["section"]) && !empty($_POST["CC"]) && !empty($_POST["CCnumber"]);
	}

	function validCC() {
		if (strlen($_POST["CCnumber"]) === 16) {
			if ($_POST["CC"] === "Visa") {
				return substr($_POST["CCnumber"], 0, 1) == "4";
			} else if ($_POST["CC"] === "MasterCard") {
				return substr($_POST["CCnumber"], 0, 1) == "5";
			}
			return true;
		} else {
			return false;
		}
	}

	function luhn() {
		$num = (int) $_POST["CCnumber"];
		$sum = 0;
		for ($i = 15; $i >= 0; $i--) {
			if ($i % 2 != 0) {
				$sum += $num % 10;
				$num = (int) ($num / 10);
			} else {
				$temp = 2 * ($num % 10);
				if ($temp < 10) {
					$sum += $temp;
				} else {
					while ($temp != 0) {
						$sum += $temp % 10;
						$temp = (int) ($temp / 10);
					}
				}
			}
		}
		return $sum % 10 == 0;
	}
?>

















