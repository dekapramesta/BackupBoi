<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function __construct()
    {

    }

    public function listByWisata(Request $req, $wisataId) {
        if (!is_numeric($wisataId))
            return response()->json(['error' => 'Bad Request'], 400);
        
        $list_komentar = DB::select("SELECT * FROM komentar WHERE wisata_id = ?", [ intval($wisataId) ]);

        return response()->json([ 'list_komentar' => $list_komentar ]);
    }

    public function create(Request $request, $wisataId) {
        if (is_null($request->input('komentar')) ||
            is_null($request->input('rating')) ||
            !is_numeric($wisataId))
            return response()->json(['error' => 'Bad Request'], 400);
        
        $wisata = DB::selectOne("SELECT wisata_nama FROM wisata WHERE wisata_id = ?", [ $wisataId ]);
        if (is_null($wisata))
            return response()->json(['error' => 'Not Found', 'message' => 'Wisata not found'], 404);
        
        $affectedRow = DB::insert("
            INSERT INTO komentar (`komentar_ip`,`komentar_deskripsi`,`komentar_tgl`,`komentar_nilai_rating`, `wisata_id`)
            VALUES(?, ?, NOW(), ?, ?);
        ", [
            $request->ip(),
            $request->input('komentar'),
            $request->input('rating'),
            $wisataId
        ]);
        if ($affectedRow)
            return response()->json([
                'message' => 'Komentar created'
            ]);
        
        return response()->json(['error' => 'Internal Server Error' ], 500);
    }
}


