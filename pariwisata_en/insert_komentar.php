<?php
date_default_timezone_set('Asia/Jakarta');
$tanggal_saiki = date("Y-m-d h:i:s");
//echo $tanggal_saiki."<br>";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, x-xsrf-token");

// try{
//     $con = new PDO('mysql:host=localhost;port=3307;dbname=db_anugerah','root','');

//     //$dbsql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        }
//     catch (PDOException $exception){
//         print "Koneksi sql Gagal :". $exception->getMessage()."<br />";
//    die();
// }

include "koneksi.php";

$data = json_decode(file_get_contents("php://input"));
$komentar_ip = mysqli_real_escape_string($conn, $data->ip_rating);
$komentar_deskripsi = mysqli_real_escape_string($conn, $data->komentar);
$komentar_tgl = date("Y-m-d");
$komentar_nilai_rating = mysqli_real_escape_string($conn, $data->nilai);
$wisata_id = mysqli_real_escape_string($conn, $data->wisata_id);

	$array = array();
	
	
	$sql = "INSERT INTO komentar(komentar_ip, komentar_deskripsi,komentar_tgl,komentar_nilai_rating,wisata_id) values ('$komentar_ip','$komentar_deskripsi','$komentar_tgl','$komentar_nilai_rating','$wisata_id')";
	//exit("$sql");
	if (!mysqli_query($conn, $sql)) {
	  die('Error: ' . mysqli_error($conn));
	}
	echo "1 record added";





mysqli_close($conn);
?>