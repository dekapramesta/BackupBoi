<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
	include "koneksi.php";
		$query  = "select avg(komentar.komentar_nilai_rating) as rating, komentar.wisata_id, wisata.wisata_nama, foto.url_file_foto from komentar
		left outer join wisata on wisata.wisata_id = komentar.wisata_id
		left outer join foto on komentar.wisata_id = foto.wisata_id
                WHERE komentar.komentar_nilai_rating >= 4.5
		 group by komentar.wisata_id asc limit 5";
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
	

?>
