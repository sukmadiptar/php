<?php

require_once __DIR__ . '/vendor/autoload.php';
require 'func.php';

$karyawan = query("SELECT * FROM karyawan");

$mpdf = new \Mpdf\Mpdf();

$html = '
<!DOCTYPE html>
<html>
<head>
	<title>Daftar Karyawan</title>
</head>
<body>
	<h1 align="center">Daftar Karyawan</h1>
	<table border="1" cellpadding="10" cellspacing="0" style="margin: 0 auto; width: fit-content">
		<tr>
			<th>No.</th>
			<th>Nama</th>
			<th>Gender</th>
			<th>NIK</th>
			<th>Email</th>
			<th>Jobdesk</th>
			<th>Foto</th>
		</tr>';
	$i = 1;
	foreach($karyawan as $row) {
		$html .= '
		<tr>
			<td>'. $i++ .'</td>
			<td>'. $row["nama"] .'</td>
			<td>'. $row["gender"] .'</td>
			<td>'. $row["nik"] .'</td>
			<td>'. $row["email"] .'</td>
			<td>'. $row["jobdesk"] .'</td>
			<td><img src="img/'. $row["foto"] .'" width="50" align="center"></td>
		</tr>
		';
	}
$html .= '</table>

</body>

</html>
';

$mpdf->WriteHTML($html);
$mpdf->Output('daftar_karyawan','I');
?>
