<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

	include "koneksi.php";
	if(isset($_GET['id_wisata'])&&isset($_GET['ip'])){
		$id_wisata = $_GET['id_wisata'];
		$ip = $_GET['ip'];
		$tgl = date("Y-m-d");
		
		$query  = "select * from komentar where wisata_id='$id_wisata' and komentar_ip='$ip' and komentar_tgl='$tgl'";
		$result = $conn->query($query);


		$num_results = $result->num_rows;
		//cek jika nilai 0

		if($num_results>0){
			echo json_encode(false);
		}else{
			echo json_encode(true);
		}
		$result->free();

		$conn->close();
	}
	else
	{
		echo json_encode(null);
	}

?>