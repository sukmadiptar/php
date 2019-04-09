<?php 

session_start();
require 'func.php';

// cek kue

if( isset($_COOKIE['bambang']) && isset($_COOKIE['bambing'])){
	# code...
	$bambang = $_COOKIE['bambang'];
	$bambing = $_COOKIE['bambing'];

	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $bambang"
	);
	
	$row = mysqli_fetch_assoc($result);

			if ( $bambang === hash('sha256', $row['username'])) {
			# code...
			$_SESSION['login'] = true;
		}
}

if ( isset($_SESSION["login"])) {
	# code...
	header("Location: index.php");
	exit();
}


if ( isset($_POST["login"])) {
	# code...
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	//cek username
	if ( mysqli_num_rows($result) === 1 ) {
		# code...
		// cek password
		$row = mysqli_fetch_assoc($result);
		if ( password_verify ($password, $row["password"]) ){
			//set session 
				$_SESSION["login"] = true;

			//jika cookie used
			if ( isset($_POST["remember"])) {
				# code...
				setcookie('bambang', $row['id'], time()+60);
				setcookie('bambing', hash('sha256', $row['username']),
				time()+60);
			}
			//lalu pindah
			header("Location: index.php");
			exit();
		}
	}

	$error = true;
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Welcome to romantic bla</title>
	<style type="text/css">
		label{
			display: block;
		}

	</style>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<?php if ( isset($error) ) : ?>
		<p style="color: red; font-style: italic;">Username / password salah!</p>
<?php endif; ?>
<form action="" method="post">
<h1 align="center">Login</h1>
<div class="container">
		<label for="username"><b>Username</b></label>
		<input type="text" name="username" id="username" required>

		<label for="password"><b>Password</b></label>
		<input type="password" name="password" id="password" required>
      	
		<button type="submit" name="login" id="login">Login</button>
	
	
		<label for="remember" id="remember"><input id="remember" type="checkbox" name="remember" id="remember"> Remember me!</label>
    
</div>
	
  	<div class="container loginbtm">
    	<p>Don't have an account? <a href="regis.php">Register here!</a>.</p>
  	</div>
	
</form>


</body>
</html>