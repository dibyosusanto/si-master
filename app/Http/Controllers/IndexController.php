<?php

namespace App\Http\Controllers;
use App\Masjid;
use App\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){
        $jmlMasjid = DB::table('masjids')
            ->select('id_masjid')
            ->count();
        $jmlPengurus = DB::table('penguruses')
            ->select('id_pengurus')
            ->count();
        $jmlJamaahWeb = DB::table('jamaah__webs')
            ->select('id_jamaah')
            ->count();
        $jmlJamaahMjd = DB::table('jamaah__masjids')
            ->select('id_jamaah')
            ->count();
        $jmlJamaah = $jmlJamaahWeb + $jmlJamaahMjd;
        return view('index', compact('jmlMasjid', 'jmlPengurus', 'jmlJamaah'));
    }

    public function daftar(){
        return view('daftar');
    }


}
