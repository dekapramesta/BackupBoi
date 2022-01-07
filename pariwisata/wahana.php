<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
    // variabel koneksi
        include "koneksi.php";
        $id = @$_GET['wisata_id']; 
    // koneksi ke database
     
    // query untuk menampilkan data
        $query = 'SELECT wahana_wisata.*, wahana.* FROM wahana_wisata 	
		LEFT OUTER JOIN wahana on wahana.wahana_id = wahana_wisata.wahana_id
		WHERE wahana_wisata.wisata_id = "'.$id.'"';
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