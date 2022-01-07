<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
    // variabel koneksi
        include "koneksi.php";
        $id = @$_GET['wisata_id']; 
    // koneksi ke database
     
    // query untuk menampilkan data
        $query = 'SELECT fasilitas_wisata.*, wisata_berfasilitas.* FROM fasilitas_wisata 	
		LEFT OUTER JOIN wisata_berfasilitas on wisata_berfasilitas.faswis_id = fasilitas_wisata.faswis_id
		WHERE wisata_berfasilitas.wisata_id = "'.$id.'" AND wistas_status="Y"';
		//exit("$query");
        $result = $conn->query($query);
    // execute the query
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