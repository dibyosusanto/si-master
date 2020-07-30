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
use App\Jamaah_Masjid;
use App\Announcements;
use App\Kegiatan;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

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
        
        $announcements = Announcements::where('publish', 1)->orderBy('created_at')->paginate(5);

        return view('admin.index', compact('jml_user', 'jml_masjid', 'jml_infaq', 'jml_zakat', 'announcements'));
    }

   //User

    public function list_user()
    {
        $users = User::all();
        return view('admin.list_user', compact('users'));
    }

    public function input_admin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            
        ]);
        
        $admin = User::create([
                'email' => ($request->email),
                'password' => bcrypt($request->password),
                'role' => 1
        ]);
        return redirect(route('admin.list_admin'))->with('status', 'Data berhasil ditambahkan');
    }
    public function list_jamaah_web()
    {
        $jamaahs = User::where('role', 3)->get();
        return view('admin.list_jamaah_web', compact('jamaahs'));
    }

    public function input_jamaah_web(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'nama_jamaah' => 'required|string|min:3',
            'no_hp' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            
        ]);
        
        $user = User::create([
                'email' => ($request->email),
                'password' => bcrypt($request->password),
                'role' => 3
        ]);

        $jamaah_web = Jamaah_Web::create([
            'nama_jamaah' => ucwords($request->nama_jamaah),
            'no_hp' => $request->no_hp,
            'alamat' => ucwords($request->alamat),
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_user' => $user->id
        ]);

        return redirect(route('admin.list_jamaah_web'))->with('status', 'Data berhasil ditambahkan');
    }

    public function list_admin()
    {
        $users = User::where('role', 1)->get();
        return view('admin.list_admin', compact('users'));
    }

    //Masjid

    public function masjid()
    {
        $masjids = Masjid::all();        
        return view('admin.masjid', compact('masjids'));
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
                 'no_rekening' => $request->no_rekening,
                 'no_tlp' => $request->no_tlp
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
            'no_rekening' => 'required|integer',
            'no_tlp' => 'required'
        ]);

        $masjid = Masjid::find($id_masjid);
        $masjid->nama_masjid = ucwords($request->get('nama_masjid'));
        $masjid->alamat = ucwords($request->get('alamat'));
        $masjid->no_rekening = $request->get('no_rekening');
        $masjid->no_tlp = $request->get('no_tlp');
        $masjid->status_validasi = $request->get('status_validasi');
        $masjid->save();
        return redirect(route('admin.masjid'))->with(['status' => $request->nama_masjid . ' berhasil diubah']);
    }

    public function destroy_masjid(Request $request, $id_masjid){
        $masjid = Masjid::find($id_masjid);
        $masjid->delete();
        return redirect(route('admin.masjid'))->with(['status' => $request->nama_masjid . 'Data Berhasil Dihapus']);
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
        $announcements = Announcements::all();
        return view('admin.list_pengumuman', compact('announcements'));
    }

    public function input_pengumuman()
    {
        return view('admin.input_pengumuman');
    }

    public function store_pengumuman(Request $request)
    {
        
        $pengumuman = Announcements::create([
            'judul' => $request->judul,
            'isi' => $request->konten
        ]);

        return redirect(route('admin.list_pengumuman'))->with('status', 'Data berhasil disimpan');
    }

    public function detail_pengumuman($id_announcement)
    {
        $announcement = Announcements::where('id_announcement', $id_announcement)->first();
        return view('admin.detail_pengumuman', compact('announcement'));
    }

    public function edit_pengumuman($id_announcement)
    {
        $announcement = Announcements::where('id_announcement', $id_announcement)->first();
        return view('admin.edit_pengumuman', compact('announcement'));
    }

    public function update_pengumuman(Request $request, $id_announcement)
    {
        Announcements::where('id_announcement', $id_announcement)->update([
            'judul' => $request->judul,
            'isi' => $request->konten,
            'publish' => $request->publish
        ]);
        return redirect(route('admin.list_pengumuman'))->with('status', 'Data berhasil diubah');
    }

    public function destroy_pengumuman($id_announcement)
    {
        Announcements::destroy($id_announcement);
        return redirect(route('admin.list_pengumuman'))->with('status', 'Data berhasil dihapus');
    }

    public function publish_pengumuman($id_announcement)
    {
        Announcements::where('id_announcement', $id_announcement)->update([
            'publish' => 1
        ]);
        return redirect(route('admin.list_pengumuman'))->with('status', 'Data berhasil dipublish');
    }
    
    public function list_pengurus()
    {
        $penguruses = User::where('role', 2)->get();
        $masjids = Masjid::all();
        return view('admin.list_pengurus', compact('penguruses', 'masjids'));
    }

    public function input_pengurus(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'nama_pengurus' => 'required|string|min:3',
            'no_hp' => 'required',
            'id_masjid' => 'required',
            'alamat' => 'required',
            
        ]);
        
        $user = User::create([
                'email' => ($request->email),
                'password' => bcrypt($request->password),
                'role' => 2
        ]);

        $pengurus = Pengurus::create([
            'nama_pengurus' => ucwords($request->nama_pengurus),
            'no_hp' => $request->no_hp,
            'alamat' => ucwords($request->alamat),
            'id_masjid' => $request->id_masjid,
            'id_user' => $user->id
        ]);
        return redirect(route('admin.list_pengurus'))->with('status', 'Data berhasil ditambahkan');
    }

    public function detail_pengurus($id_pengurus)
    {
        $pengurus = Pengurus::where('id_pengurus', $id_pengurus)->first();
        return view('admin.detail_pengurus', compact('pengurus'));
    }

    public function infaq_web()
    {
        $infaq_web_all = Infaq_Web::all();
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
        $infaq_web = Infaq_Web::where('id_infaq', $id_infaq)->first();
        return view('admin.edit_infaq_web', compact('infaq_web'));
    }

    public function update_infaq_web(Request $request, $id_infaq)
    {
        Infaq_Web::where('id_infaq', $id_infaq)
            ->update([
                'nominal' => $request->nominal,
                'status_validasi' => $request->status_validasi,
            ]);
        return redirect(route('admin.infaq_web'))->with('status', 'Data berhasil diubah');
    }

    public function destroy_infaq_web($id_infaq)
    {
        Infaq_Web::destroy($id_infaq);
        return redirect(route('admin.infaq_web'))->with('status', 'Data berhasil dihapus');
    }

    public function zakat_web_all()
    {
        $zakat_web_all = Zakat_Fitrah_Web::all();
        $sum_zakat_v = Zakat_Fitrah_Web::where('status_validasi', 1)->sum('nominal');
        $sum_zakat = Zakat_Fitrah_Web::where('status_validasi', 0)->sum('nominal');
        return view('admin.zakat_web', compact('zakat_web_all', 'sum_zakat_v', 'sum_zakat'));
    }

    public function detail_zakat_web($id_zakat)
    {
        $zakat_web = Zakat_Fitrah_Web::where('id_zakat', $id_zakat)->first();
        return view('admin.detail_zakat_web', compact('zakat_web'));
    }

    public function edit_zakat_web($id_zakat)
    {
        $zakat_web = Zakat_Fitrah_Web::where('id_zakat', $id_zakat)->first();
        return view('admin.edit_zakat_web', compact('zakat_web'));
    }

    public function update_zakat_web(Request $request, $id_zakat)
    {
        Zakat_Fitrah_Web::where('id_zakat', $id_zakat)
            ->update([
                'status_validasi' => $request->status_validasi,
            ]);
        return redirect(route('admin.zakat_web'))->with('status', 'Data berhasil diubah');
    }
    public function validasi_zakat($id_zakat)
    {
        Zakat_Fitrah_Web::where('id_zakat', $id_zakat)
            ->update([
                'status_validasi' => 1,
            ]);
        return redirect(route('admin.zakat_web'))->with('status', 'Data berhasil divalidasi');
    }

    public function delete_zakat_web($id_zakat)
    {
        Zakat_Fitrah_Web::destroy($id_zakat);
        return redirect(route('admin.zakat_web'))->with('status', 'Data berhasil dihapus');
    }

    public function infaq_masjid(){
        // $infaq_masjids = Infaq_Masjid::all();
        $masjids = Masjid::all();
        return view('admin.infaq_masjid', compact('masjids'));
    }

    public function findJamaahName(Request $request)
    {
        $data = Jamaah_Masjid::select('nama_jamaah', 'id_jamaah')->where('id_masjid', $request->id_masjid)->take(100)->get();
        return response()->json($data);
    }

    public function input_infaq(Request $request)
    {
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        $this->validate($request, [
            'tgl_infaq' => 'required',
            'nominal' => 'required|integer',
            'id_jamaah' => 'required'
        ]);

        $infaq_masjid = Infaq_Masjid::create([
            'tgl_infaq' => $request->tgl_infaq,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'id_jamaah' => $request->id_jamaah,
            'id_masjid' => $pengurus->id_masjid,
            'id_pengurus' => $pengurus->id_pengurus
        ]);
        $jamaahs = Jamaah_Masjid::where('id_masjid', $request->get('id_masjid'))
            ->pluck('nama_jamaah', 'id_jamaah');
        
        return response()->json($jamaahs);
    }

    public function detail_infaq_masjid($id_infaq)
    {
        $detail_infaq = Infaq_Masjid::where('id_infaq', $id_infaq)->first();
        return view('pengurus.detail_infaq_masjid', compact('detail_infaq'));
    }

    public function edit_infaq_masjid($id_infaq)
    {
        
        $jamaah_masjid = DB::table('jamaah__masjids')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        $pengurus_masjid = DB::table('penguruses')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        $infaq = Infaq_Masjid::where('id_infaq', $id_infaq)->first();
        return view('pengurus.edit_infaq_masjid', compact('infaq', 'jamaah_masjid', 'pengurus_masjid'))->with('status', 'Data berhasil diperbarui');
    }

    public function update_infaq_masjid(Request $request, $id_infaq)
    {
        $this->validate($request, [
            'tgl_infaq' => 'required',
            'nominal' => 'required|integer',
            'id_jamaah' => 'required'
        ]);

        $pengurus_masjid = Pengurus::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->first();
        $infaq_masjid = Infaq_Masjid::find($id_infaq);
        $infaq_masjid->nominal = $request->get('nominal');
        $infaq_masjid->tgl_infaq = $request->get('tgl_infaq');
        $infaq_masjid->keterangan = $request->get('keterangan');
        $infaq_masjid->id_jamaah = $request->get('id_jamaah');
        $infaq_masjid->id_pengurus = $pengurus_masjid->id_pengurus;
        $infaq_masjid->save();

        return redirect(route('pengurus.infaq_masjid'))->with('status', 'Data berhasil diedit!');
    }

    public function delete_infaq_masjid($id_infaq)
    {
        $infaq_masjid = Infaq_Masjid::find($id_infaq);
        $infaq_masjid->delete();
        return redirect(route('pengurus.infaq_masjid'))->with('status', 'Data berhasil dihapus');
    }
}
