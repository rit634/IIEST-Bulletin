<?php
	session_start();

	$_SESSION=array();

	session_destroy();
	echo '<h1 style="color: blue; text-align: center;">Thanks For Login !!!!</h1>';
	header("refresh:2;url=home.php");

	exit;
?>