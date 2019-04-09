<?php 
require 'func.php'; 

if(isset($_POST["register"])){
	if(registrasi($_POST) > 0){
		echo"
			<script>
				alert('berhasil di tambah');
			</script>
		";
	} else {
		echo mysqli_error($conn);
	}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Registrasi</title>
	<link rel="stylesheet" type="text/css" href="css/regis.css">
</head>
<body>

	<form action="" method="post">
		<h1 align="center">Registrasi</h1>
		<div class="container">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" required="">

				<label for="password">Password</label>
				<input type="password" name="password" id="password" required="">
			
				<label for="password2">Confirm Password</label>
				<input type="password" name="password2" id="password2" required="">
			
				<button type="submit" name="registerbtn" class="registerbtn" req>Register</button>
		</div>
		<div class="container signin">
    		<p>Already have an account? <a href="login.php">Sign in!</a>.</p>
  		</div>
	</form>
</body>
</html>