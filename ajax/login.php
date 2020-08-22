<?php 

	header('Content-type: application/json');	
	
	require_once('../conf/config.php');
	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if($link === false)
		die("Could not connect.");
	$result = array("result" => false);
	if($_POST['user'] && $_POST['password']) {
		$user = mysqli_real_escape_string($link,$_POST['user']);
		$pass = mysqli_real_escape_string($link,$_POST['password']);
		$sql = "SELECT user FROM user WHERE user='" . $user . "'";
		if($res = mysqli_query($link, $sql)) {
			if(mysqli_num_rows($res)==0) {
				$sql = "INSERT INTO user VALUES('" . $user . "'";
				$sql .= ", SHA1('" . $pass . "'))";
				mysqli_query($link,$sql);
				$result['result']=true;
				$result['new']=true;
			}
			else {
				$sql = "SELECT user FROM user WHERE user='" . $user . "' AND password = SHA1('";
				$sql .= $pass . "')";
				$res = mysqli_query($link, $sql);
				if(mysqli_num_rows($res)!=0) {
					$sql = "SELECT game FROM owned WHERE user='" . $user . "'";
					$res = mysqli_query($link, $sql);
					while($row=mysqli_fetch_array($res)) {
						$owned[] = $row['game'];
					}
					$result['result'] = true;
					$result['owned'] = $owned;
				}
			}
		}
		if($result['result'] == true) {
			$sql = "SELECT game FROM game";
			$res = mysqli_query($link, $sql);
			while($row = mysqli_fetch_array($res))
				$games[] = $row['game'];
			$result['games'] = $games;
			$result['user'] = $user;
		}
	}
	echo json_encode($result);
 ?>