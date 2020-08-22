<?php 

	// Add new games to the database.

	require_once('../conf/config.php');
	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if($link === false)
		die("Could not connect.");
	$game = mysqli_real_escape_string($link,$_GET['game']);
	$min = intval(mysqli_real_escape_string($link,$_GET['min']));
	$max = intval(mysqli_real_escape_string($link,$_GET['max']));
	$sql = "INSERT INTO game VALUES('".$game."',".$min.",".$max.")";
	echo (mysqli_query($link,$sql)?$game:false);
?>