<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

include "koneksi.php";

$query  = "SELECT
	wisata.wisata_id,wisata.wisata_nama, foto.*
FROM
	wisata
LEFT OUTER JOIN foto ON foto.wisata_id = wisata.wisata_id
GROUP BY  wisata.wisata_nama ORDER BY wisata.wisata_id ASC LIMIT 5";
//exit("$query");
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