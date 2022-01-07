<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

include "koneksi.php";
$tgl = $_GET['tgl'];
$query  = "select * from event where event_tgl_pelaksanaan = $tgl";
$result = $conn->query($query);

$num_results = $result->num_rows;
//cek jika nilai 0

if($num_results>0){
	$array = array();
	
	while($row = $result->fetch_assoc()){
		//untuk mengekstrak data
		extract($row);
		
		$array[]= $row;
	}
	
	echo json_encode($array);
}else{
	echo "Data Kosong";
}


$result->free();

$conn->close();  
?>