<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
	# code...
	header("Location: login.php");
	exit();
}
require 'func.php';

//pjitination
$pijitPage 		= 3;
$jumlahData 	= count(query("SELECT * FROM karyawan"));
$jumlahPijitHal = ceil($jumlahData / $pijitPage);
$currPijit 		= ( isset($_GET["pijit"]) ) ? $_GET["pijit"] : 1;

$firstD = ( $jumlahPijitHal * $currPijit ) - $jumlahPijitHal;

$karyawan = query("SELECT * FROM karyawan LIMIT $firstD, $pijitPage");

if ( isset($_POST["cari"])) {
	# code...
	$karyawan = cari($_POST["keyword"]);
}

$male 	= $conn->query("SELECT * FROM karyawan WHERE gender = 'male'");
$female = $conn->query("SELECT * FROM karyawan WHERE gender = 'female'");

$tot_male 	= mysqli_num_rows($male);
$tot_female = mysqli_num_rows($female);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Data Karyawan</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<!-- ini buat ficon -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<!-- ini chartJs -->
	<!-- <script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/chart.min.js"></script>
	
	<script type="text/javascript" src="js/chartbar.js"></script> -->
	<!-- <script type="text/javascript" src="data.php"></script> -->
	
	<!-- ini buat Google chart -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Gender', 'Total'],
          //['Gender', 'Female', {role: 'style'}],
          ['Male',   <?= $tot_male   ?>],
          ['Female', <?= $tot_female ?>]
        ]);

        var options = {
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('column'));

        google.visualization.events.addListener(chart, 'ready', function () {
      	chart.setSelection([{row:99, column:1}]);
      	 // Select one of the points.
      	png = '<a href="' + chart.getImageURI() + '">Printable version</a>';
     	 console.log(png);
  	  });

        chart.draw(data, options);
      }
    </script>

</head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script>
document.addEventListener('click', function() {
	if(!event.target.classList.contains('link')) return;
	event.target.classList.add('active');

	var links = document.querySelectorAll('.link');

		for(var i=0; i < links.length; i++){
			if(links[i] === event.target) continue;
			links[i].classList.remove('active');
			}
}, false);
</script>


<body>
<!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
<h1 align="center">Data Karyawan</a></h1>

<br><br>
	<div id="searchbar" >
		<form method="post">
			<input type="text" name="keyword" size="34" placeholder="search here" autocomplete="off" id="keyword">	
			
			<button type="submit" name="cari" id="searchbtn"><i class="fas fa-search" style="color: white;"></i></button>
			<img src="img/loader.gif" class="loader">
		</form>
	</div>
<br>
	<div id="tambahBtn1">
		<button id="tambahBtn" onclick="window.location.href='tambah.php'">Add New Data</button>
	</div>
<br>
	<div class="print1" ">
		<form target="_blank" action="print.php" class="">
		<button  type="submit" class="printBtn">Print</button>
		</form>
	</div>
<br>
	
	
<br>
<!-- navbar pijit start-->

<div id="pagination">

<?php if( $currPijit > 1 ) : ?>
<!-- navigasi kiri --> <a href="?pijit= <?= $currPijit -1; ?>">PREV</a> 
<?php endif; ?>

<?php for( $i = 1; $i <= $jumlahPijitHal; $i++) :  ?>
	<?php if( $i == $currPijit) : ?>
			<a href="?pijit= <?= $i; ?> " 
			   style="font-weight: bold; color:black;" class="link" >
			   <?= $i; ?></a>
	<?php else : ?>
			<a href="?pijit= <?= $i; ?> " class="link"><?= $i;  ?></a>
	<?php endif; ?>
<?php endfor; ?>

<?php if( $currPijit < $jumlahPijitHal ) : ?>
<!-- navigasi kanan --><a href="?pijit= <?= $currPijit +1; ?>">NEXT</a>
<?php endif; ?>
</div>

<!-- navbar pijit end -->

<br>
<div id="content" >
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
		<td><?=$i+$firstD; ?></td>
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
</div>
<br>

<div id="column" style="width: 700px; height: 500px; margin: 0 auto"></div>

<div style="margin: 0 auto; width: fit-content;">
	<button id="logoutbtn" onclick="window.location.href='logout.php'">Logout
	</button>
<br>
</div>
<script src="js/script.js" type="text/javascript"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script> -->

<!-- <script src="js/main.js" type="text/javascript"></script> -->
</body>
</html>