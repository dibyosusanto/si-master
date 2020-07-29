<?php

namespace App\Http\Controllers;
use App\Masjid;
use App\Pengurus;
use App\Announcements;
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
        $announcements = Announcements::where('publish', 1)->orderBy('created_at')->paginate(5);
        $masjids = Masjid::where('status_validasi', 1)->get();
        
        return view('guest.index', compact('jmlMasjid', 'jmlPengurus', 'jmlJamaah', 'announcements', 'masjids'));
    }

    public function faq()
    {
        return view('guest.faq');
    }

    public function detail_pengumuman($id_announcement)
    {
        $announcement = Announcements::where('id_announcement', $id_announcement)->first();
        return view('guest.detail_pengumuman', compact('announcement'));
    }

    public function daftar(){
        return view('guest.daftar');
    }

    public function detail_masjid($id_masjid)
    {
        $masjid = Masjid::where('id_masjid', $id_masjid)->first();
        return view('guest.detail_masjid', compact('masjid'));
    }

    public function input_masjid(Request $request){
        $this->validate($request, [
            'nama_masjid' => 'required|string|min:6',
            'alamat' => 'required|string',
            'no_rekening' => 'required|integer|unique:masjids,no_rekening',
            'no_tlp' => 'required'
        ]);

        try{
            $masjid = Masjid::create([
                 'nama_masjid' => ucwords($request->nama_masjid),
                 'alamat' => ucwords($request->alamat),
                 'no_rekening' => $request->no_rekening,
                 'no_tlp' => $request->no_tlp
            ]);
            return redirect(route('index.daftar'))->with(['status' => ucwords($request->nama_masjid) .' berhasil ditambahkan. Harap menunggu konfirmasi oleh admin melalui telepon ke nomor telepon yang telah didaftarkan']);
        }catch(\Exception $e){
            return redirect(route('index.daftar'))->with(['error' => $e->getMessage()]);
        }
    }


}
