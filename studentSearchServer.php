<?php
	session_start();
	$_SESSION['author'] = $_POST['author'];
	$_SESSION['lexile'] = $_POST['lexile'];
	$_SESSION['length'] = $_POST['length'];
	$_SESSION['genre'] = $_POST['genre'];
	$_SESSION['trait1'] = $_POST['trait1'];
	$_SESSION['trait2'] = $_POST['trait2'];
?>
