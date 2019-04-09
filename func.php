<?php 

$conn = mysqli_connect("localhost", "root", "", "test1");

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
 	while( $row = mysqli_fetch_assoc($result)){
 		$rows[] = $row;
 	}
 	return $rows;
 }

function addData($data){
 	global $conn;

 	$nama 	= htmlspecialchars($data["nama"]);
 	$gender = htmlspecialchars($data["gender"]);
	$nik 	= htmlspecialchars($data["nik"]);
	$email 	= htmlspecialchars($data["email"]);
	$jobdesk= htmlspecialchars($data["jobdesk"]);
	
	// $male_status = 'unchecked';

	$foto = upload();
	if ( !$foto) {
		# code...
		return false;
	}

	$query = "INSERT INTO karyawan 
				VALUES
	('', '$nama', '$gender', '$nik', '$email', 
			'$jobdesk', '$foto')
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
 }

function upload(){
 	$namaFile 	= $_FILES['foto']['name'];
 	$sizeFile 	= $_FILES['foto']['size'];
 	$error 		= $_FILES['foto']['error'];
 	$tmpName 	= $_FILES['foto']['tmp_name'];

 	if ( $error === 4) {
 		# code...
 		echo "
 			<script>
 				alert('Choose your image!!');
 			</script>
 		";
 		return false;
 	}
 	$ekstenFoto = ['jpg','jpeg','png'];
 	$ekstenFoto1 = explode('.', $namaFile);
 	$ekstenFoto1 = strtolower(end($ekstenFoto1));

 	if (!in_array($ekstenFoto1, $ekstenFoto)) {
 		# code...
 		echo "
 			<script>
 				alert('Not image!!');
 			</script>
 		";
 		return false;
 	}
 	if ($sizeFile > 1000000) {
 		# code...
 		echo "
 			<script>
 				alert('image too Large');
 			</script>
 		";
 		return false;
 	}

 	$randNameFile = uniqid();
 	$randNameFile .= '.';
 	$randNameFile .= $ekstenFoto1;

 	move_uploaded_file($tmpName, 'img/' . $randNameFile);
 	return $randNameFile;
 }

function delData($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM karyawan WHERE id = $id");

	return mysqli_affected_rows($conn);
}
function editData($data){
	global $conn;

	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$gender = htmlspecialchars($data["gender"]);
	$nik = htmlspecialchars($data["nik"]);
	$email = htmlspecialchars($data["email"]);
	$jobdesk = htmlspecialchars($data["jobdesk"]);
	$oldImg = htmlspecialchars($data["oldImg"]);
	
	if ( $_FILES['foto']['error'] === 4) {
		# code...
		$foto = $oldImg;
	} else {
		$foto = upload();
	}

	$query = "UPDATE karyawan SET
			nik 	= '$nik', 
			nama 	= '$nama',
			gender  = '$gender',
			email 	= '$email', 
			jobdesk = '$jobdesk',
			foto 	= '$foto'

			WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function cari($keyword){
	// $keyword1 = strtoupper($keyword);
	$query = "SELECT * FROM karyawan
			WHERE
			nama LIKE '$keyword%' OR
			gender LIKE '$keyword%' OR
			nik LIKE '$keyword%' OR
			email LIKE '$keyword%' OR
			jobdesk LIKE '$keyword%'
	";
		return query($query);

}

function registrasi($data){

	global $conn;

	$username = strtolower(stripslashes($data["username"] ) );
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	//cek duplicate user
	$result = mysqli_query($conn, 
		"SELECT username 
		 FROM user WHERE
		 username = '$username'
		");
	if ( mysqli_fetch_assoc($result) ) {
		# code...
		echo"
			<script>
			alert('username sudah terdaftar');
			</script>
		";
		return false;
	}

	//cek conf pass

	if ( $password !== $password2) {
		# code...
		echo "<script>
			alert('konfirm password tidak cocok!');
		</script>
		";
		return false;
	} 
	
	// encrypt password
	$password = password_hash($password, PASSWORD_DEFAULT);
	
	//input ke database
	mysqli_query($conn, 
		"INSERT INTO user 
		VALUES('', '$username', '$password')");
	return mysqli_affected_rows($conn);
}

	
?>