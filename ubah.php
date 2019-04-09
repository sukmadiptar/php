<?php 

session_start();
if ( !isset($_SESSION["login"]) ) {
	# code...
	header("Location: login.php");
	exit();
}

require 'func.php';

$id = $_GET["id"];
//var_dump("$id");

$kar = query("SELECT * FROM karyawan WHERE id = $id")[0];
//var_dump("kary");

if ( isset($_POST["submit"])) {
	if ( editData($_POST) > 0) {
		# code...
		echo "
			<script>
				alert('data berhasil di edit');
				document.location.href = 'index.php';
			</script>
		";
	}else{
		echo "
			<script>
				alert('data gagal di ubah');
				document.location.href = 'index.php';
			</script>
		";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ubah data Karyawan</title>
	<link rel="stylesheet" type="text/css" href="css/ubah.css">
	<link rel="stylesheet" type="text/css" href="css/tambah.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
	 
	

	<form action="" method="post" enctype="multipart/form-data">
	<div>
		<h1 align="left">
				<a href="index.php" class="backbtn">	
						<i class="fas fa-arrow-left" style="
  margin-left: 16px;" >
						</i>
				</a>
			<div class="title1">
			Edit Data
			</div>
		</h1>		
	</div>
			<div class="container">
				<input type="hidden" name="id" value="<?= $kar["id"] ?>">
				<input type="hidden" name="oldImg" value="<?= $kar["foto"] ?>">	
				<label for="nama">Nama</label>
				<input type="text" name="nama" id="nama" required 
				value="<?= $kar["nama"] ?>">

				<label for="gender">Gender</label><br>
				<input type="radio" name="gender" id="male" required 
				<?php if($kar['gender']=="male"){
							echo "checked";
						} ?>
				value="male"
				>Male</input>
				<input type="radio" name="gender" id="female" required
				<?php if($kar['gender']=="female"){
							echo "checked";
						} ?>
				value="female"
				>Female</input>
				
				<br><br>
				<label for="nik">NIK</label>
				<input type="text" name="nik" id="nik" required 
				value="<?= $kar["nik"] ?>">
			
				<label for="email">Email</label>
				<input type="text" name="email" id="email" required value="<?= $kar["email"] ?>">
			
				<label for="jobdesk">Jobdesk</label>
				<input type="text" name="jobdesk" id="jobdesk" required value="<?= $kar["jobdesk"] ?>">
			
				<label for="foto">Foto</label>
				<img src="img/<?= $kar["foto"]; ?>" width="30%">
				<br><br>
				<input type="file" name="foto" id="foto">
			
				<button type="submit" name="submit" class="submitbtn">Edit Data</button>
			</div>

	</form>
</body>
</html>