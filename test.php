<?php 
require 'func.php';


$male = $conn->query("SELECT * FROM karyawan WHERE gender = 'male'");
$female = $conn->query("SELECT * FROM karyawan WHERE gender = 'female'");

$tot_male   = mysqli_num_rows($male);
$tot_female = mysqli_num_rows($female);


 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Gender', 'Jumlah'],
          ['Male',     <?= $tot_male   ?>],
          ['Female',   <?= $tot_female ?>]
        ]);

        var options = {
          title: 'Jumlah Karyawan menurut Jenis Kelamin'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
<body>
<div id="piechart" style="width: 900px; height: 500px; text-align: center;"></div>

</body>
</html>