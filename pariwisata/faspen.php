<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
    // variabel koneksi
        include "koneksi.php";
        $id = @$_GET['faspen_id']; 
    // koneksi ke database
     
    // query untuk menampilkan data
        $query = 'SELECT fasilitas_pendukung.*,wisata_berpendukung.* FROM fasilitas_pendukung
		  left outer join wisata_berpendukung on wisata_berpendukung.faspen_id = fasilitas_pendukung.faspen_id	 	
		WHERE fasilitas_pendukung.faspen_id = "'.$id.'"';
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