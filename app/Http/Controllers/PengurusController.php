<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengurus;
use App\Masjid;
use App\Jamaah_Masjid;
use App\User;
use App\Infaq_Web;
use App\Infaq_Masjid;
use App\Jamaah_Web;
use App\Zakat_Fitrah_Masjid;
use App\Zakat_Fitrah_Web;
use App\Kas_Keluar;
use App\Muzakki_Masjid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;

class PengurusController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('pengurus');
    }

    public function profile($id){
        $user = User::find($id);
        if(!empty($pengurus = Pengurus::where('id_user', $id)->first())){
            return view('pengurus.profile', compact('user', 'pengurus'));
        }else{
            return redirect(route('pengurus.create', $user->id));
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_pengurus' => 'required|string',
            'no_hp' => 'required|numeric',
            'alamat' => 'required',
            'id_masjid' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $pengurus = Pengurus::where('id_user', $id)->first();
        $pengurus->nama_pengurus = ucwords($request->get('nama_pengurus'));
        $pengurus->no_hp = $request->get('no_hp');
        $pengurus->alamat = ucwords($request->get('alamat'));
        $pengurus->save();

        $user = User::find($id);
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect(route('pengurus.profile', $id))->with('status', 'Data berhasil diperbarui');
    }

    public function index()
    {
        $jmlJamaahMjd = DB::table('jamaah__masjids')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')
            ->count();
        $jml_infaq_web = DB::table('infaq__webs')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 0')
            ->count();
        $user = User::where('id', Auth::user()->id)->first();
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        if(!empty($pengurus)){
            return view('pengurus.index', compact('jmlJamaahMjd', 'jml_infaq_web'));
        }else{
            return redirect(route('pengurus.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }
        
    }

    public function lihatJamaah(){
        $jamaah = DB::table('jamaah__masjids')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        $user = User::where('id', Auth::user()->id)->first();
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        if(!empty($pengurus)){
            return view('pengurus.lihatJamaah', compact('jamaah'));
        }else{
            return redirect(route('pengurus.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }
    }

    public function create(){
        return view('pengurus.isidata');
    }

    public function input_jamaah(Request $request)
    {
        $this->validate($request, [
            'nama_jamaah' => 'required|string',
            'no_hp' => 'required|numeric|unique:jamaah__masjids,no_hp',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'required|date'
        ]);
        
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();

        $jamaah_masjid = Jamaah_Masjid::create([
            'nama_jamaah' => ucwords($request->get('nama_jamaah')),
            'no_hp' => $request->get('no_hp'),
            'alamat' => ucwords($request->get('alamat')),
            'jenis_kelamin' => $request->get('jenis_kelamin'),
            'tgl_lahir' => $request->get('tanggal_lahir'),
            'id_masjid' => $pengurus->id_masjid
        ]);

        return redirect(route('pengurus.lihatJamaah'))->with('status', $jamaah_masjid->nama_jamaah  . ' berhasil ditambahkan!');
    }

    public function jamaah_masjid_show($id_jamaah){
        $jamaah_masjid = DB::table('jamaah__masjids')
            ->select('*')
            ->where('id_jamaah', '=', $id_jamaah)->get();
        return view('pengurus.show_jamaah_masjid', compact('jamaah_masjid'));
    }

    public function jamaah_masjid_edit(Request $request, $id_jamaah)
    {
        $jamaah_masjid = Jamaah_Masjid::find($id_jamaah);
        return view('pengurus.edit_jamaah_masjid', compact('jamaah_masjid'));
    }

    public function jamaah_masjid_update(Request $request, $id_jamaah)
    {
        $jamaah_masjid = Jamaah_Masjid::find($id_jamaah);
        $jamaah_masjid->nama_jamaah = ucwords($request->get('nama_jamaah'));
        $jamaah_masjid->no_hp = $request->get('no_hp');
        $jamaah_masjid->alamat = ucwords($request->get('alamat'));
        $jamaah_masjid->jenis_kelamin = $request->get('jenis_kelamin');
        $jamaah_masjid->tgl_lahir = $request->get('tanggal_lahir');

        $jamaah_masjid->save();
        return redirect(route('pengurus.lihatJamaah'))->with('status', $jamaah_masjid->nama_jamaah  . ' berhasil diedit!');
    }


    public function jamaah_masjid_destroy(Request $request, $id_jamaah){
        $jamaah_masjid= Jamaah_Masjid::find($id_jamaah);
        $jamaah_masjid->delete();
        return redirect(route('pengurus.lihatJamaah'))->with('status', $jamaah_masjid->nama_jamaah  . ' berhasil dihapus!');
    }

    public function infaq_web_all(){
        $user = User::where('id', Auth::user()->id)->first();
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        $infaq_web_all = Infaq_Web::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        $sum_infaq_v = Infaq_Web::selectRaw('SUM(nominal) as total_infaq')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 1')->first();
        $sum_infaq = Infaq_Web::selectRaw('SUM(nominal) as total_infaq')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 0')->first();
        if(!empty($pengurus)){
            return view('pengurus.infaq_web_all', compact('infaq_web_all', 'sum_infaq_v', 'sum_infaq'));
        }else{
            return redirect(route('pengurus.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }
    }
    
    public function validasiInfaq(Request $request, $id){
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        Infaq_Web::where('id_infaq', $id)
            ->update([
                'status_validasi' => 1,
                'id_pengurus' => $pengurus->id_pengurus
            ]);
        return redirect(route('pengurus.infaq_web_all'))->with('status', 'Data berhasil divalidasi');
    }

    public function infaq_web_valid()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        $infaq_web_valid = Infaq_Web::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 1')->get();
        $sum_infaq_v = Infaq_Web::selectRaw('SUM(nominal) as total_infaq')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 1')->first();
        if(!empty($pengurus)){
            return view('pengurus.infaq_valid', compact('infaq_web_valid', 'sum_infaq_v'));
        }else{
            return redirect(route('pengurus.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }
    }

    public function infaq_web_belum_valid()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        $infaq_web_belum_valid = Infaq_Web::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 0')->get();
        $sum_infaq = Infaq_Web::selectRaw('SUM(nominal) as total_infaq')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 0')->first();
        if(!empty($pengurus)){
            return view('pengurus.infaq_belum_valid', compact('infaq_web_belum_valid', 'sum_infaq'));
        }else{
            return redirect(route('pengurus.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }    
    }

    public function modal_bukti($id_infaq)
    {
        $bukti = Infaq_Web::where('id_infaq', $id_infaq)->first();
        return view('pengurus.bukti', compact('bukti'));
    }

    public function infaq_masjid(){
        $user = User::where('id', Auth::user()->id)->first();
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        $sum_infaq = Infaq_Masjid::selectRaw('SUM(nominal) as total_infaq')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->first();
        $infaq_masjids = Infaq_Masjid::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        $jamaah_masjid = DB::table('jamaah__masjids')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        if(!empty($pengurus)){
            return view('pengurus.infaq_masjid', compact('infaq_masjids', 'jamaah_masjid', 'sum_infaq'));
        }else{
            return redirect(route('pengurus.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }
        
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
        return redirect(route('pengurus.infaq_masjid'))->with('status', 'Data berhasil ditambahkan!');
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

    public function zakat_masjid()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        $jamaah_masjid = Jamaah_Masjid::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        $zakat_masjids = Zakat_Fitrah_Masjid::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        if(!empty($pengurus)){
            return view('pengurus.zakat_masjid', compact('zakat_masjids', 'jamaah_masjid'));
        }else{
            return redirect(route('pengurus.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }
        
    }

    public function input_zakat(Request $request)
    {
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        $this->validate($request, [
            'tgl_zakat' => 'required',
            'jenis' => 'required',
            'banyaknya' => 'required',
            'id_jamaah' => 'required'
        ]);
        $zakat = Zakat_Fitrah_Masjid::create([
            'tgl_zakat' => $request->tgl_zakat,
            'jenis' => $request->jenis,
            'jml_muzakki' => $request->jml_muzakki,
            'banyaknya' => $request->banyaknya,
            'keterangan' => $request->keterangan,
            'id_jamaah' => $request->id_jamaah,
            'id_masjid' => $pengurus->id_masjid,
            'id_pengurus' => $pengurus->id_pengurus
        ]);
        return view('pengurus.input_muzakki', ['id_zakat' => $zakat->id_zakat, 'jml_muzakki' => $zakat->jml_muzakki])->with('status', 'Data berhasil disimpan');
    }

    public function store_muzakki(Request $request)
    {        
        $nama_muzakki = $request->nama_muzakki;
        foreach($nama_muzakki as $key => $no){
            $input['nama_muzakki'] = $nama_muzakki[$key];
            $input['id_zakat'] = $request->id_zakat;
            Muzakki_Masjid::create($input);
        }
        return redirect(route('pengurus.zakat_masjid'))->with('status', 'Data zakat berhasil disimpan');
    }

    public function detail_zakat_masjid($id_zakat)
    {
        $detail_zakat_masjid = Zakat_Fitrah_Masjid::where('id_zakat', $id_zakat)->first();
        return view('pengurus.detail_zakat_masjid', compact('detail_zakat_masjid'));
    }

    public function edit_zakat_masjid($id_zakat)
    {
        $jamaah_masjid = Jamaah_Masjid::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        $pengurus_masjid = Pengurus::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        $detail_zakat_masjid = Zakat_Fitrah_Masjid::where('id_zakat', $id_zakat)->first();
        return view('pengurus.edit_zakat_masjid', compact('detail_zakat_masjid', 'jamaah_masjid', 'pengurus_masjid'))->with('status', 'Data berhasil diperbarui');
    }

    public function pengeluaran()
    {  
        $user = User::where('id', Auth::user()->id)->first();
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        $pengeluaran_masjids = Kas_Keluar::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        if(!empty($pengurus)){
            return view('pengurus.pengeluaran', compact('pengeluaran_masjids'));
        }else{
            return redirect(route('pengurus.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }
        
    }    

    public function input_pengeluaran(Request $request)
    {
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        $pengeluaran = Kas_Keluar::create([
            'tgl_pengeluaran' => $request->tgl_pengeluaran,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'id_pengurus' => $pengurus->id_pengurus,
            'id_masjid' => $pengurus->id_masjid
        ]);

        return redirect(route('pengurus.pengeluaran'))->with('status', 'Data berhasil disimpan');
    }

    public function zakat_web_all()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        $zakat_web_all = Zakat_Fitrah_Web::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        $sum_zakat_v = Zakat_Fitrah_Web::selectRaw('SUM(nominal) as total_zakat')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 1')->first();
        $sum_zakat = Zakat_Fitrah_Web::selectRaw('SUM(nominal) as total_zakat')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 0')->first();
        if(!empty($pengurus)){
            return view('pengurus.zakat_web', compact('zakat_web_all', 'sum_zakat_v', 'sum_zakat'));
        }else{
            return redirect(route('pengurus.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }
    }

    public function bukti_zakat($id_zakat)
    {
        $bukti = Zakat_Fitrah_Web::where('id_zakat', $id_zakat)->first();
        return view('pengurus.bukti_zakat', compact('bukti'));
    }

    public function validasi_zakat($id_zakat)
    {
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        Zakat_Fitrah_Web::where('id_zakat', $id_zakat)
            ->update([
                'status_validasi' => 1,
                'id_pengurus' => $pengurus->id_pengurus
            ]);
        return redirect(route('pengurus.zakat_web_all'))->with('status', 'Data berhasil divalidasi');
    }

    public function ringkasan()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        $sum_infaq_masjid = Infaq_Masjid::selectRaw('SUM(nominal) as total_infaq_masjid')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->first();
        $sum_infaq_v = Infaq_Web::selectRaw('SUM(nominal) as total_infaq_web')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 1')->first();
        $sum_zakat_masjid_beras = Zakat_Fitrah_Masjid::selectRaw('SUM(banyaknya) as total_zakat_masjid_beras')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and jenis = 1')->first();
        $sum_zakat_masjid_uang = Zakat_Fitrah_Masjid::selectRaw('SUM(banyaknya) as total_zakat_masjid_uang')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and jenis = 2')->first();
        $sum_pengeluaran = Kas_Keluar::selectRaw('SUM(nominal) as total_pengeluaran')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->first();
        if(!empty($pengurus)){
            return view('pengurus.ringkasan', compact('sum_infaq_masjid', 'sum_infaq_v', 'sum_zakat_masjid_beras', 'sum_zakat_masjid_uang', 'sum_pengeluaran'));
        }else{
            return redirect(route('pengurus.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }
    }    
}
