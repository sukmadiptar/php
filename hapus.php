<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
	# code...
	header("Location: login.php");
	exit();
}

require 'func.php';

$id = $_GET["id"];

if ( delData($id) > 0) {
	# code...
	echo "
			<script>
				alert('data berhasil di hapus');
				document.location.href = 'index.php';
			</script>
		";
}else{
	echo "
			<script>
				alert('data gagal di hapus');
				document.location.href = 'index.php';
			</script>
		";
}

 ?>