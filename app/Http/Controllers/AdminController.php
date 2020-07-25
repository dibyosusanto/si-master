<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pengurus;
use App\Masjid;
use App\Infaq_Web;
use App\Infaq_Masjid;
use App\Zakat_Fitrah_Web;
use App\Zakat_Fitrah_Masjid;
use App\Jamaah_Web;
use App\Kegiatan;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::all();
        $masjid = Masjid::all();
        $infaq_web = Infaq_Web::all();
        $infaq_masjid = Infaq_Masjid::all();
        $zakat_web = Zakat_Fitrah_Web::all();
        $zakat_masjid = Zakat_Fitrah_Masjid::all();
        $jml_user = $user->count();
        $jml_masjid = $masjid->count();
        $jml_infaq = ($infaq_web->count()) + ($infaq_masjid->count());
        $jml_zakat = ($zakat_masjid->count()) + ($zakat_web->count());
        
        return view('admin.index', compact('jml_user', 'jml_masjid', 'jml_infaq', 'jml_zakat'));
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

    public function list_admin()
    {
        $users = User::where('role', 1)->get();
        return view('admin.list_admin', compact('users'));
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

    public function list_pengumuman()
    {
        
        return view('admin.list_pengumuman');
    }

    public function input_masjid(Request $request){
        $this->validate($request, [
            'nama_masjid' => 'required|string|min:6',
            'alamat' => 'required|string',
            'no_rekening' => 'required|integer|unique:masjids,no_rekening'
        ]);

        try{
            $masjid = Masjid::create([
                 'nama_masjid' => ucwords($request->nama_masjid),
                 'alamat' => ucwords($request->alamat),
                 'no_rekening' => $request->no_rekening
            ]);
            return redirect(route('admin.masjid'))->with(['status' => ucwords($request->nama_masjid) .' berhasil ditambahkan!']);
        }catch(\Exception $e){
            return redirect(route('masjid.create'))->with(['error' => $e->getMessage()]);
        }
    }

    public function edit_masjid($id_masjid)
    {
        $masjid = Masjid::where('id_masjid', $id_masjid)->first();
        return view('admin.edit_masjid', compact('masjid'));
    }

    public function update_masjid(Request $request, $id_masjid){
        $this->validate($request, [
            'nama_masjid' => 'required|string|min:6',
            'alamat' => 'required|string',
            'no_rekening' => 'required|integer'
        ]);

        $masjid = Masjid::find($id_masjid);
        $masjid->nama_masjid = ucwords($request->get('nama_masjid'));
        $masjid->alamat = ucwords($request->get('alamat'));
        $masjid->no_rekening = $request->get('no_rekening');
        $masjid->save();
        return redirect(route('admin.masjid'))->with(['status' => $request->nama_masjid . ' berhasil diubah']);
    }

    public function destroy_masjid(Request $request, $id_masjid){
        $masjid = Masjid::find($id_masjid);
        $masjid->delete();
        return redirect(route('admin.masjid'))->with(['status' => $request->nama_masjid . 'Data Berhasil Dihapus']);
    }

    public function infaq_web()
    {
        $infaq_web_all = Infaq_Web::orderBy('id_masjid')->get();
        return view('admin.infaq_web', compact('infaq_web_all'));
    }

    public function bukti_infaq($id_infaq)
    {
        $bukti = Infaq_Web::where('id_infaq', $id_infaq)->first();
        return view('admin.bukti_infaq', compact('bukti'));
    }
    
    public function detail_infaq_web($id_infaq)
    {
        $infaq_web = Infaq_Web::where('id_infaq', $id_infaq)->first();
        return view('admin.detail_infaq_web', compact('infaq_web'));
    }

    public function validasi_infaq($id_infaq)
    {
        Infaq_Web::where('id_infaq', $id_infaq)->update([
            'status_validasi' => 1,
        ]);
        return redirect(route('admin.infaq_web'))->with('status', 'Data berhasil divalidasi');
    }

    public function edit_infaq_web($id_infaq)
    {
        $infaq_web = Infaq_Web::where('id_infaq', $id_infaq);
        return view('admin.edit_infaq_web', compact('infaq_web'));
    }

    public function destroy_infaq_web($id_infaq)
    {
        Infaq_Web::destroy($id_infaq);
        return redirect(route('admin.infaq_web'))->with('status', 'Data berhasil dihapus');
    }
}
