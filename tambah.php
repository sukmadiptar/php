<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
	# code...
	header("Location: login.php");
	exit();
}
require 'func.php';
//$conn = mysqli_connect("localhost", "root", "", "test1");

$male_status = 'unchecked';
$female_status = 'unchecked';

if (isset($_POST['submit'])) {

	$selected_radio = $_POST['gender'];
	
		if ($selected_radio == 'male') {
			$male_status = 'checked';

		}
		else if ($selected_radio == 'female') {
			$female_status = 'checked';
		}
}

if ( isset($_POST["submit"])) {
	if ( addData($_POST) > 0) {
		# code...
		echo "
			<script>
				alert('data berhasil di tambahkan');
				
			</script>
		";
	}else{
		echo "
			<script>
				alert('data gagal di tambahkan');
			</script>
		";
	}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar Karyawan</title>
</head>

<link rel="stylesheet" type="text/css" href="css/tambah.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<body>
	

	
	<form action="" method="post" enctype="multipart/form-data">
	<h1 align="left">
		<div>
		<button class="backbtn" onclick="window.location.href='index.php'">
			<i class="fas fa-arrow-left"></i>
		</button>
		</div>
		<div class="title1">
		Add New Data
		</div>
	</h1>

			<div class="container">
				<label for="nama">Name</label>
				<input type="text" name="nama" id="nama" required="">
			
				<label for="gender">gender</label>
				<input type="radio" name="gender" value="male" 
				<?= $male_status; ?>>Male</input>
				<input type="radio" name="gender" value="female" <?= $male_status; ?>>Female</input>

				<label for="nik">NIK</label>
				<input type="text" name="nik" id="nik" required="">
			
				<label for="email">Email</label>
				<input type="text" name="email" id="email" required="">
			
				<label for="jobdesk">Jobdesk</label>
				<input type="text" name="jobdesk" id="jobdesk" required="">
			
				<label for="foto">Photo</label><br>
				<input type="file" name="foto" id="foto" required="">
				
				<button type="submit" name="submit" class="submitbtn">Add Data</button>
			</div>

	</form>
</body>
</html>