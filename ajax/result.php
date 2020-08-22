<?php 
	header('Content-type: application/json');	
	
	require_once('../conf/config.php');
	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if($link === false)
		die("Could not connect.");
	if($_GET['user']) {
		
		$sql = "SELECT game.game AS game FROM (";
		$sql .= "SELECT * FROM game WHERE min<=" . sizeof($_GET['user']);
		$sql .=" AND max>=" . sizeof($_GET['user']);
		$sql .= ") AS game LEFT JOIN (";
		$sql .= "SELECT * FROM owned WHERE ";
		// loop to add users
		for($i=0; $i<sizeof($_GET['user']); $i++) {
			$sql .= "user='" . mysqli_real_escape_string($link,$_GET['user'][$i]) . "'";
			if($i < sizeof($_GET['user'])-1)
				$sql .= " OR ";
		}

		$sql .= ") AS owned USING(game) GROUP BY game ";
		$sql .="HAVING COUNT(owned.user)>=" . sizeof($_GET['user']);
		
		//echo $sql;
		$res = mysqli_query($link,$sql);
		while($row = mysqli_fetch_array($res))
			$games[] = $row['game'];
	}
	echo json_encode($games);
?>