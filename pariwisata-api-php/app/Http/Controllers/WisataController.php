<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getList() {
	$results = DB::select("SELECT w.*, COUNT(k.wisata_id) AS jumlah_komentar, SUM(k.komentar_nilai_rating) AS rating_raw FROM wisata w
LEFT OUTER JOIN komentar k ON k.wisata_id = w.wisata_id GROUP BY w.wisata_id");

        foreach ($results as $wisata) {
            $wisata->tags = explode(" ", $wisata->wisata_tag);
            unset($wisata->wisata_tag);
            $wisata->rating = $wisata->jumlah_komentar == 0 ? 0 : $wisata->rating_raw / $wisata->jumlah_komentar;
        }
        return response()->json([ 'list_wisata' => $results ]);

    }

    public function getTop(Request $request, $num) {

        if(!is_numeric($num)) {
            return response()->json(['error' => 'Bad Request'], 400);
        }

        $list_komentar = DB::select("SELECT
            SUM(k.komentar_nilai_rating) as rating_raw,
            COUNT(k.komentar_nilai_rating) as jumlah,
            k.wisata_id,
            w.*
            FROM komentar k JOIN wisata w ON k.wisata_id = w.wisata_id
            GROUP BY k.wisata_id
            ORDER BY rating_raw DESC
            LIMIT ?", [intval($num)]);

        foreach($list_komentar as $wisata) {
            $wisata->tags = explode(" ", $wisata->wisata_tag);
            unset($wisata->wisata_tag);
            $wisata->rating = $wisata->jumlah == 0 ? 0 : $wisata->rating_raw / $wisata->jumlah;
        }
        return response()->json([ 'list_wisata' => $list_komentar ]);

    }

    public function getListByKategori(Request $request, $namaKategori) {
        $kategori = DB::selectOne("SELECT * FROM kategori WHERE kategori_nama = ? ", [ 
$namaKategori ]);
	if (is_null($kategori))
	    return response()->json([ 'error' => 'Not Found' ], 404);
        $wisata = DB::select("SELECT * FROM wisata WHERE kategori_id = ?", [ 
$kategori->kategori_id ]);
	return response()->json([ 'list_wisata' => $wisata ]);
    }

    public function getOne(Request $request, $wisataId) {
        if (!is_numeric($wisataId))
            return response()->json(['error' => 'Bad Request'], 400);

        $wisata = DB::selectOne("SELECT w.*, SUM(k.komentar_nilai_rating) AS rating_raw FROM wisata w JOIN komentar k ON w.wisata_id = k.wisata_id WHERE w.wisata_id = ?", [ $wisataId ]);

        if (is_null($wisata))
            return response()->json(['error' => 'Not Found'], 404);

        $komentar = DB::select("SELECT k.* FROM komentar k WHERE k.wisata_id = ?", [ $wisataId ]);
        $wahana = DB::select("SELECT w.*, ww.wahwis_htm as wahana_htm FROM wahana_wisata ww JOIN wahana w ON ww.wahana_id = w.wahana_id WHERE ww.wisata_id = ?", [ $wisataId ]);
        $fasilitas = DB::select("SELECT f.* FROM wisata_berfasilitas w JOIN fasilitas_wisata f ON f.faswis_id = w.faswis_id WHERE w.wisata_id = ?", [ $wisataId ]);
        $fasilitasPendukung = DB::select("SELECT f.*, w.wiskung_nama, w.wiskung_alamat, w.wiskung_telp, w.wiskung_website, w.wiskung_latitude, w.wiskung_longitude, w.wiskung_url_foto FROM wisata_berpendukung w JOIN fasilitas_pendukung f ON f.faspen_id = w.faspen_id WHERE w.wisata_id = ?", [ $wisataId ]);
	//$kfp = DB::select("SELECT * FROM fasilitas_pendukung");
        $kategori_raw = DB::select("SELECT k.kategori_nama FROM wisata w JOIN kategori k ON k.kategori_id = w.kategori_id WHERE w.wisata_nama = ? ", [ $wisata->wisata_nama ]);
        $kategori = [];
        foreach($kategori_raw as $k) {
            array_push($kategori, $k->kategori_nama);
        }

        $foto = DB::select("SELECT f.* FROM foto f WHERE f.wisata_id = ? ", [ $wisataId ]);
	$fp2 = [];
	foreach($fasilitasPendukung as $fp){
		$found = false;
		foreach(array_values($fp2) as $val) {
			if($val->name == $fp->faspen_nama){
				$found = true;
				array_push($val->data, $fp);
				break;
			}
		}
		if(!$found){
			array_push($fp2, (object)array(
				'nama' => $fp->faspen_nama,
				'icon' => $fp->faspen_icon,
				'data' => array($fp)
			));
		}

	}

        $wisata->tags = explode(' ', $wisata->wisata_tag);
        $wisata = (object)array_merge((array)$wisata, [
            'kategori' => $kategori,
	    'fasilitas_pendukung' => $fp2,
            'fasilitas' => $fasilitas,
            'wahana' => $wahana,
            'komentar' => $komentar,
            'rating' => (count($komentar) == 0 ? 0 : $wisata->rating_raw / count($komentar)),
            'foto' => $foto
            ]);
        unset($wisata->wisata_tag);
        unset($wisata->rating_raw);

	foreach($wahana as $wh) {
		$wh->wahana_deskripsi = strip_tags($wh->wahana_deskripsi);
	}

        return response()->json([
            'wisata' => $wisata,
        ]);
    }

}
