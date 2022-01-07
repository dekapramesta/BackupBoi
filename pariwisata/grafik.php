<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

	include "koneksi.php";
	if(isset($_GET['kode'])&& isset($_GET['tahun'])){
		$kode = $_GET['kode'];
		$tahun = $_GET['tahun'];

		$query  = "select * from grafik where kode=$kode and tahun=$tahun";
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
			echo json_encode(null);
		}


		$result->free();

		$conn->close();
	}
	else
	{
		echo json_encode(null);
	}

?>
