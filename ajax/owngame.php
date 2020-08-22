<?php
	if($_GET['user'] && $_GET['game']) {
		require_once('../conf/config.php');
		$link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		if($link === false)
			die("Could not connect.");
		$user = mysqli_real_escape_string($link,$_GET['user']);
		$game = mysqli_real_escape_string($link,$_GET['game']);
		if($_GET['value']=="true") {
			$sql = "SELECT * FROM owned WHERE user='" . $user . "' AND game='" . $game . "'";
			$res=mysqli_query($link,$sql);
			if(mysqli_num_rows($res)==0) {
				$sql = "INSERT INTO owned VALUES(id,'".$user."','".$game."')";
				mysqli_query($link,$sql);
			}
		}
		else {
			$sql = "DELETE FROM owned WHERE user='" . $user . "' AND game='" . $game . "'";
			mysqli_query($link,$sql);
		}
	} ?>