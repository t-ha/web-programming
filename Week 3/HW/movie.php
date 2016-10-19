<!DOCTYPE html>
<html>
<!--
Timothy Ha
04.23.14
CSE 154 AP
Jiaming Li
Assignment #3: Movie Review Part Deux
movie.php

Creates a page that can take parameters and shows different movie reviews
based on the parameter.
-->
	<?php
		# set the parameter as a usable variable
		$film = $_GET["film"];
	?>
	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<link href="movie.css" type="text/css" rel="stylesheet">
		<title>Rancid Tomatoes</title>
	</head>


	<body>
		<?php
			banner();
			$info = file("$film/info.txt", FILE_IGNORE_NEW_LINES);
		?>

		<h1><?= $info[0] ?> (<?= $info[1] ?>)</h1>
			
		<div id="content">

			<?php
				mainBanner($info);
			?>

			<div id="sidebar">
				<img src="<?= $film ?>/overview.png" alt="general overview">

				<dl>
					<?php
						foreach (file("$film/overview.txt", FILE_IGNORE_NEW_LINES) as $section) {
							$temp = explode(":", $section);
					?>
					<dt><?= $temp[0] ?></dt>
					<dd><?= $temp[1] ?></dd>
					<?php
						}
					?>
				</dl>
			</div>

			<div id="main">
				<?php
					$review_num = critic_reviews($film);
				?>
			</div>

			<p id="page">(1-<?= $review_num ?>) of <?= $review_num ?></p>
			<?php
				mainBanner($info);
			?>
		</div>

		<div id="validators">
			<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5"></a><br>
			<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS"></a>
		</div>

		<?php
		banner();
		?>
	

	</body>
</html>




<?php

# Prints the Rancid Tomatoes banner
	function banner() {
?>
		<div class="banner">
			<img src="https://webster.cs.washington.edu/images/rancidbanner.png" alt="Rancid Tomatoes">
		</div>
<?php
	}

# Prints the banner showing the rating (percentage) and
# its respective fresh/rotten tomato with the passed in file
	function mainBanner($info_text) {
?>
		<div class="mainBanner">
			<?php
				if ($info_text[2] >= 60) {
			?>
					<img src="https://webster.cs.washington.edu/images/freshlarge.png" alt="Fresh Tomatoe">
			<?php
				} else {
			?>
					<img src="https://webster.cs.washington.edu/images/rottenlarge.png" alt="Rotten Tomatoe">
			<?php
				}
			?>
			<span class="rating"><?= $info_text[2] ?>%</span>
		</div>
<?php
	}

# retrieves the review files and runs show_reviews differently
# based on the number of reviews and if it has odd or even number
# returns the number of reviews
	function critic_reviews($film) {
		$review_files = glob("$film/review*.txt");
		$num_rev = count($review_files);

		if ($num_rev > 1) {
			$half = (int) ($num_rev / 2);
			$helper = $half;
			if ($num_rev % 2 == 0) {
				show_reviews($review_files, $half, $helper);
				show_reviews($review_files, $half, $num_rev);
			} else {
				show_reviews($review_files, $half + 1, $helper + 1);
				show_reviews($review_files, $half, $num_rev);
			}
		} else {
			show_reviews($review_files, 1, 1);
		}

		return $num_rev;
	}

# prints the columns and their reviews with the given review files, and passed in integers
# if there is an odd even number of reviews, print the extra odd
# review on the left column
	function show_reviews($files, $half, $temp) {
?>
		<div class="columns">
			<?php
				for ($i = $temp - $half; $i < $temp; $i++) {
					$review = file($files[$i], FILE_IGNORE_NEW_LINES);
			?>
			<p class="review">
				<?php
					if (strcmp($review[1], "FRESH") == 0) {
				?>
						<img src="https://webster.cs.washington.edu/images/fresh.gif" alt="Fresh Review">
				<?php
					} else {
				?>
						<img src="https://webster.cs.washington.edu/images/rotten.gif" alt="Rotten Review">
				<?php
					}
				?>
				<q><?= trim($review[0]) ?></q>
			</p>
			<p class="avatar">
				<img src="https://webster.cs.washington.edu/images/critic.gif" alt="Critic">
				<?= $review[2] ?> <br>
				<span class="publication"><?= $review[3] ?></span>
			</p>
			<?php
				}
			?>
		</div>
<?php
	}
?>


