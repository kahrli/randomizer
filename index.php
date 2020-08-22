<?php 
	require_once('conf/config.php');
?>

<!DOCTYPE html>

<html>
<head>
	<title>Randomizer</title>
	<link rel="stylesheet" 
		href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
		integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" 
		crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" 
		crossorigin="anonymous"></script>
	<script 
		src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" 
		integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
		crossorigin="anonymous"></script>
	<script 
		src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
		integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" 
		crossorigin="anonymous"></script>

<script>
 <!--
	var USER_GLOBAL;
	
	function revert(which) {
		((which=='random')?$("#result"):$("#loggedin")).addClass("d-none");
		((which=='random')?$("#random"):$("#login")).removeClass("d-none");
		if(which=='login')
			$("#owned").html('');
	}	
 //-->
</script>

	<script src="js/random.js"></script>
	<script src="js/login.js"></script>
	<script src="js/creategame.js"></script>
	<script src="js/ownedgame.js"></script>
</head>

<body>
<div class="container mb-5">

<h1 class="row mt-5 mb-5 text-primary">Randomizer</h1>
<div class="row">

<div class="col-md-6 mb-5" id="login">
	<h2>You are:</h2>
	<form>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Name</span>
			</div>
			<input type="text" class="form-control" placeholder="Name" name="user">
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Password</span>
			</div>
			<input type="password" class="form-control" 
				placeholder="Password" name="password">
		</div>
		<button type="submit" class="btn btn-primary btn-lg btn-block" 
			value="Login">Login</button>
		<button type="submit" class="btn btn-secondary btn-lg btn-block" 
			value="Register">Register</button>
	</form>
</div>
			
<div class="col-md-6 d-none mb-5" id="loggedin">
	<h2></h2>
	<form id="ownedgame"></form>

	<form id="creategame">
		<input type="text" class="form-control" placeholder="Add new game" 
			name="game" required>
		<div class="input-group mb-3">
			<input type="number" class="form-control" placeholder="min players" 
				name="min" required>
			<input type="number" class="form-control" placeholder="max players" 
				name="max" required>
			<input type="submit" class="form-control btn-primary" value="&rarr;">
		</div>
	</form>
	<button class="btn-secondary btn-lg btn-block btn" onclick="revert('login')">
		&larr; Change user</button>
</div>
			
<div class="col-md-6 mb-5" id="random">
	<h2>Players:</h2>
<?php 
	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if($link === false)
		die("Could not connect.");
	$sql = "SELECT user FROM user";
	if($res = mysqli_query($link, $sql)) {
?>
	<form>
<?php 
		if(mysqli_num_rows($res) > 0) {
			while($row = mysqli_fetch_array($res)) {
?>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<div class="input-group-text">
					<input type="checkbox" 
						value="<?php echo htmlspecialchars($row['user']); ?>" name="user[]">
				</div>
			</div><div class="form-control"><?php echo $row['user']; ?></div>
		</div>
<?php 
			}
		}
?>
		<button type="submit" class="btn btn-primary btn-block btn-lg">
			Randomize <span id="rarr">&rarr;</span></button>
	</form>
<?php
	}
?>
</div>

<div class="col-md-6 d-none mb-5" id="result">
	<h2>Results:</h2>
	<ul class="list-group mb-5 mt-5"></ul>
	<button class="btn-primary btn-lg btn-block btn" onclick="revert('random')">
		&larr; Try again</button>
</div>

</div>
</div>

</body>
<?php mysqli_close($link); ?>
</html>