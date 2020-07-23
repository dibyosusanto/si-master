<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pengurus;
use App\Masjid;
use App\Infaq_Web;
use App\Zakat_Fitrah_Masjid;
use App\Jamaah_Web;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::all();
        $jml_user = $user->count();
        $masjid = Masjid::all();
        $jml_masjid = $masjid->count();
        return view('admin.index', compact('jml_user', 'jml_masjid'));
    }

    public function list_user()
    {
        $users = User::all();
        return view('admin.list_user', compact('users'));
    }

    public function list_jamaah_web()
    {
        $jamaahs = User::where('role', 3)->get();
        return view('admin.list_jamaah_web', compact('jamaahs'));
    }

    public function masjid()
    {
        $masjids = Masjid::all();        
        return view('admin.masjid', compact('masjids'));
    }

    public function detail_masjid($id_masjid)
    {
        $masjid = Masjid::where('id_masjid', $id_masjid)->first();
        return view('admin.detail_masjid', compact('masjid'));
    }

    public function detail_jamaah_web($id_user)
    {   
        $jamaah = Jamaah_Web::where('id_user', $id_user)->first();
        return view('admin.detail_jamaah_web', compact('jamaah'));
    }
}
