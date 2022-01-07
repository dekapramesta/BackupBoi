<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/* 
 * TODO:
 * serve gambar
 * /foto endpoint
 */

class Controller extends BaseController
{
    //

    public function getListBerita() {
        $list_berita = DB::select("SELECT * FROM berita");
        
        foreach($list_berita as $berita) {
            $berita->tags = explode(' ', $berita->berita_tag);
	    unset($berita->berita_tag);
	    $berita->berita_deskripsi = strip_tags($berita->berita_deskripsi);
        }

        return response()->json([ 'list_berita' => $list_berita ]);
    }

    public function getBerita(Request $req, $beritaId) {
        
        if(!is_numeric($beritaId)) {
            return response()->json(['error' => 'Bad Request'], 400);
        }

        $berita = DB::selectOne("SELECT * FROM berita WHERE berita_id = ?", [ intval($beritaId) ]);

        if (is_null($berita))
            return response()->json(['error' => 'Not Found'], 404);
        
        $berita->tags = explode(' ', $berita->berita_tag);
	$berita->berita_deskripsi = strip_tags($berita->berita_deskripsi);
        
        return response()->json([ 'berita' => $berita ]);

    }

    public function getListNearbyEvent() {
        $list_event = DB::select("SELECT *
            FROM event
            WHERE event_tgl_pelaksanaan >= NOW()
            ORDER BY event_tgl_pelaksanaan ASC");
	foreach($list_event as $event) {
		$event->tags = explode(' ', $event->event_tag);
		$event->event_deskripsi = strip_tags($event->event_deskripsi);
	}
        return response()->json([ 'list_event' => $list_event ]);
    }

    public function getListEvent() {
        $list_event = DB::select("SELECT * FROM event");
        foreach($list_event as $event) {
            $event->tags = explode(' ', $event->event_tag);
	    unset($event->event_tag);
	    $event->event_deskripsi = strip_tags($event->event_deskripsi);
        }
        return response()->json([ 'list_event' => $list_event ]);
    }

    public function getEvent(Request $req, $eventId) {

        if(!is_numeric($eventId)) {
            return response()->json(['error' => 'Bad Request'], 400);
        }

        $event = DB::selectOne("SELECT * FROM event WHERE event_id = ?", [ intval($eventId) ]);

        if (is_null($event))
            return response()->json(['error' => 'Not Found'], 404);
        $event->tags = explode(' ', $event->event_tag);
	unset($event->event_tag);
	$event->event_deskripsi = strip_tags($event->event_deskripsi);
        
        return response()->json([ 'event' => $event ]);

    }

    public function getEventByDate(Request $req, $date) {

        if(!preg_match("/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9])(?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?$/", $date))
            return response()->json([ 'error' => 'Bad Request' ], 400);
        
        $events = DB::select("SELECT * FROM  event WHERE event_tgl_pelaksanaan = ?", [ $date ]);
	foreach($events as $event){
		$event->tags = explode(' ', $event->event_tag);
		unset($event->event_tag);
		$event->event_deskripsi = strip_tags($event->event_deskripsi);
	}
        return response()->json([ 'list_event' => $events ]);

        
    }

    public function getInfo(Request $req, $year) {
        if (!is_numeric($year))
            return response()->json([ 'error' => 'Bad Request' ], 400);
        $info = DB::selectOne("SELECT * FROM info WHERE info_tahun = ? ", [ $year ]);
        if (is_null($info))
            return response()->json([ 'error' => 'Not Found' ], 404);
        return response()->json([ 'info' => $info ]);
    }

    public function listInfo() {
        $list_info = DB::select("SELECT i.* FROM info i ORDER BY i.info_tahun DESC");
        return response()->json([ 'list_info' => $list_info ]);
    }

    public function search(Request $req, $keyword) {
        $keyword = "%" . str_replace("%", "\\%", $keyword) . "%";
        $berita = DB::select("SELECT * FROM berita WHERE berita_judul LIKE ?", [ $keyword ]);
        $event = DB::select("SELECT * FROM event WHERE event_judul LIKE ?", [ $keyword ]);
        $wisata = DB::select("SELECT w.*,
		COUNT(k.wisata_id) AS jumlah_komentar,
		SUM(k.komentar_nilai_rating) AS rating_raw
		FROM wisata w
		LEFT OUTER JOIN komentar k
		ON k.wisata_id = w.wisata_id
		WHERE w.wisata_nama LIKE ? 
		GROUP BY w.wisata_id", [ $keyword ]);
		
		foreach ($berita as $b) {
		    $b->tags = explode(' ', $b->berita_tag);
		}
		foreach($event as $e) {
		    $e->tags = explode(' ', $e->event_tag);
		}
	foreach($wisata as $w) {
		$w->rating = $w->jumlah_komentar == 0 ? 0 : $w->rating_raw / $w->jumlah_komentar;
		$w->tags = explode(" ", $w->wisata_tag);
		unset($w->wisata_tag);
		unset($w->rating_raw);
	}
        return response()->json([
            'berita' => $berita,
            'event' => $event,
            'wisata' => $wisata
        ]);
    }
    public function searchTag(Request $req, $keyword) {
        $keyword = "%" . str_replace("%", "\\%", $keyword) . "%";
        $berita = DB::select("SELECT * FROM berita WHERE berita_tag LIKE ?", [ $keyword ]);
        $event = DB::select("SELECT * FROM event WHERE event_tag LIKE ?", [ $keyword ]);
        //$wisata = DB::select("SELECT * FROM wisata WHERE wisata_tag LIKE ?", [ $keyword ]);

        $wisata = DB::select("SELECT w.*,
		COUNT(k.wisata_id) AS jumlah_komentar,
		SUM(k.komentar_nilai_rating) AS rating_raw
		FROM wisata w
		LEFT OUTER JOIN komentar k
		ON k.wisata_id = w.wisata_id
		WHERE w.wisata_tag LIKE ? 
		GROUP BY w.wisata_nama", [ $keyword ]);
		
		foreach ($berita as $b) {
		    $b->tags = explode(' ', $b->berita_tag);
		}
		foreach($event as $e) {
		    $e->tags = explode(' ', $e->event_tag);
		}
	foreach($wisata as $w) {
		$w->rating = $w->jumlah_komentar == 0 ? 0 : $w->rating_raw / $w->jumlah_komentar;
		$w->tags = explode(" ", $w->wisata_tag);
		unset($w->wisata_tag);
		unset($w->rating_raw);
	}

	return response()->json([
            'berita' => $berita,
            'event' => $event,
            'wisata' => $wisata
        ]);
    }
    public function getAbout() {
	$about = DB::selectOne("SELECT * FROM about LIMIT 1");
	$about->about_deskripsi = strip_tags($about->about_deskripsi);
	return response()->json([
		'about' => $about
	]);
    }
    public function getAboutList() {
	$abouts = DB::select("SELECT * FROM about");
	foreach($abouts as $about) {
	    $about->about_deskripsi = strip_tags($about->about_deskripsi);
	}
	return response()->json([
	    'about_list' => $abouts
	]);
    }
}
