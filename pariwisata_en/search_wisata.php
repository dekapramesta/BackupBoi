<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

	include "koneksi.php";
	if(isset($_GET['query'])){
		$input = $_GET['query'];
		$query  = "(SELECT wisata.wisata_id,wisata.wisata_nama, foto.url_file_foto, 'Wisata' as type FROM wisata
		left outer join foto on foto.wisata_id=wisata.wisata_id
		WHERE wisata_nama like '%$input%' OR wisata_tag like '%$input%'
		GROUP BY wisata.wisata_nama)";

// where wisata_nama like '%$input%' or wisata_tag like '%$input%' or wisata_deskripsi like '%$input%' GROUP BY wisata.wisata_nama') 
// 		 			 	union 
// 		 			 	(Select berita_id, berita_judul, 'berita' as type from berita where berita_judul like '%$input%' or berita_deskripsi like '%$input%' or berita_tag like '%$input%')"
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
