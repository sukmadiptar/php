<?php 

require '../func.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM karyawan
			WHERE
			nama LIKE '$keyword%' OR
			gender LIKE '$keyword%' OR
			nik LIKE '$keyword%' OR
			email LIKE '$keyword%' OR
			jobdesk LIKE '$keyword%'
	";

$karyawan = query($query);
 ?>

<table border="1" cellpadding="10" cellspacing="0" style="margin: 0 auto; width: fit-content">
	<tr>
		<th>No.</th>
		<th>Action</th>
		<th>Nama</th>
		<th>Gender</th>
		<th>NIK</th>
		<th>Email</th>
		<th>Jobdesk</th>
		<th>Foto</th>
	</tr>
	<?php $i = 1; ?>
	<?php foreach($karyawan as $row) : ?>
	<tr>
		<td><?= $i;?></td>
		<td>
			<a href="ubah.php?id=<?= $row["id"]; ?>">Edit</a> | 
		    <a href="hapus.php?id=<?= $row["id"]; ?>" 
		   	   onclick="return confirm('Yakin?');">Delete</a>
		</td>
		<td><?= $row["nama"]; ?></td>
		<td><?= $row["gender"]; ?></td>
		<td><?= $row["nik"]; ?></td>
		<td><?= $row["email"]; ?></td>
		<td><?= $row["jobdesk"]; ?></td>
		<td><img src=img/<?= $row["foto"]; ?> width="50" align="center" ></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
</table>