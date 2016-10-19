<?php
	# include the file common.php
	# resume the current session then destroy it
	# redirect to start.php

	include("common.php");
	session_start();
	session_destroy();
	go_to_start();
?>