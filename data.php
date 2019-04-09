<?php
//setting header to json
header('Content-Type: application/json');
//get connection
$conn = mysqli_connect("localhost","root","","test1");

//query to get data from table
$male 	= $conn->query("SELECT gender FROM karyawan WHERE gender = 'male'");
$female = $conn->query("SELECT gender FROM karyawan WHERE gender = 'female'");
//total
$totmale = mysqli_num_rows($male);
$totfemale = mysqli_num_rows($female);
//execute query
//$result = mysqli_query();

//loop through return data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>