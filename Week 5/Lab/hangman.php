<?php
$MAX_GUESSES  = 6;
if (isset($_GET["guess"])) {
    if ($_COOKIE["guesses"] > 0 && !correctGuess()) {
      $guesses = $_COOKIE["guesses"] - 1;
      $available = str_replace($_GET["guess"], " ", $_COOKIE["available"]);
    } else {
      $guesses = 0;
      $available = $_COOKIE["available"];
    }
}  else {
  $guesses = $MAX_GUESSES;
  $available = "abcdefghijklmnopqrstuvwxyz";
}

if(isset($_COOKIE["word"])) {
  $word = $_COOKIE["word"];
} else {
  $words = file("/www/html/cse154/labs/5/words.txt", FILE_IGNORE_NEW_LINES);
  $word  = $words[rand(0, count($words))];
}

$clue = str_repeat("?", strlen($word));
setcookie("word", $word);
setcookie("guesses", $guesses);
setcookie("available", $available);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Hangman</title>
    <link href="https://webster.cs.washington.edu/cse154/labs/5/hangman.css" type="text/css" rel="stylesheet" />
  </head>
  
  <body>
    <h1>Hangman Step by Step</h1>
    
    <div>
      <img src="https://webster.cs.washington.edu/cse154/labs/5/hangman<?= $guesses ?>.gif" alt="hangman" /> <br />
      (<?= $guesses ?> guesses remaining)
    </div>
    
    <div id="clue"> <?= $clue ?> </div>
    
		<form action="hangman.php">
			<input name="guess" type="text" size="1" maxlength="1" autofocus="autofocus" />
			<input type="submit" value="Guess" />
		</form>
    
    
		<form action="hangman.php" method="post">
			<input name="newgame" type="hidden" value="true" />
			<input type="submit" value="New Game" />
		</form>

    <div id="hint">
    	HINT: The word is: <code>"<?= $word ?>"</code> <br />
    	The letters available are: <code>"<?= $available ?>"</code>
    </div>
  </body>
</html>





<?php
function correctGuess() {
  return preg_match($_GET["guess"], $_COOKIE["word"]);
}
?>






