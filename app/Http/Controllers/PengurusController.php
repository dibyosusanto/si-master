<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
use App\Announcements;
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
        ]);

        $pengurus = Pengurus::where('id_user', $id)->update([
            'nama_pengurus' => ucwords($request->nama_pengurus),
            'no_hp' => $request->no_hp,
            'alamat' => ucwords($request->alamat)
        ]);
        

        return redirect(route('pengurus.profile', $id))->with('status', 'Data berhasil diperbarui');
    }

   public function edit_kata_sandi()
   {
       $user = User::where('id', Auth::user()->id)->first();
       return view('pengurus.edit_kata_sandi');
   } 
   
   public function update_kata_sandi(Request $request, $id_user)
   {
    $user = User::where('id', $id_user)->first();
    if(!Hash::check($request->password, $user->password)){
        return redirect(route('pengurus.edit_kata_sandi'))->with('alert', 'Password lama salah');
    }
    if($request->password_baru != $request->konfir_password){
        return redirect(route('pengurus.edit_kata_sandi'))->with('alert', 'Password baru dan konfirmasi tidak sama');
    }
    $ubah = User::where('id', $id_user)->update([
        'password' => Hash::make($request->password_baru)
    ]);
    return redirect(route('pengurus.edit_kata_sandi'))->with('status', 'Password berhasil diubah');
   }

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        $announcements = Announcements::where('publish', 1)->paginate(5);
        $masjid = Masjid::where('id_masjid', $pengurus->id_masjid)->first();
        $jmlJamaahMjd = DB::table('jamaah__masjids')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')
            ->count();
        $jml_infaq_web = DB::table('infaq__webs')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 0')
            ->count();
        $jml_zakat_web = DB::table('zakat__fitrah__webs')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 0')
            ->count();
        
        if(!empty($pengurus)){
            return view('pengurus.index', compact('masjid', 'announcements', 'jmlJamaahMjd', 'jml_infaq_web', 'jml_zakat_web'));
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
    
    public function detail_infaq_web($id_infaq)
    {
        $infaq_web = Infaq_Web::where('id_infaq', $id_infaq)->first();
        return view('pengurus.detail_infaq_web', compact('infaq_web'));
    }

    public function edit_infaq_web($id_infaq)
    {
        $infaq_web = Infaq_Web::where('id_infaq', $id_infaq)->first();
        return view('pengurus.edit_infaq_web', compact('infaq_web'));
    }

    public function update_infaq_web(Request $request, $id_infaq)
    {
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        Infaq_Web::where('id_infaq', $id_infaq)
            ->update([
                'nominal' => $request->nominal,
                'status_validasi' => $request->status_validasi,
                'id_pengurus' => $pengurus->id_pengurus
            ]);
        return redirect(route('pengurus.infaq_web_all'))->with('status', 'Data berhasil diubah');
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
        $zakat_beras = Zakat_Fitrah_Masjid::where('jenis', 1)->sum('banyaknya');
        $zakat_uang = Zakat_Fitrah_Masjid::where('jenis', 2)->sum('banyaknya');
        if(!empty($pengurus)){
            return view('pengurus.zakat_masjid', compact('zakat_masjids', 'jamaah_masjid', 'zakat_beras', 'zakat_uang'));
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

    public function update_zakat_masjid(Request $request, $id_zakat)
    {
        $jamaah_masjid = Jamaah_Masjid::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->first();
        $pengurus_masjid = Pengurus::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->first();
        $zakat = Zakat_Fitrah_Masjid::where('id_zakat', $id_zakat)->first();
        $zakats = Zakat_Fitrah_Masjid::where('id_zakat', $id_zakat)->update([
            'tgl_zakat' => $request->tgl_zakat,
            'jenis' => $request->jenis,
            'jml_muzakki' => $request->jml_muzakki,
            'banyaknya' => $request->banyaknya,
            'keterangan' => $request->keterangan,
            'id_jamaah' => $request->id_jamaah,
            'id_masjid' => $pengurus_masjid->id_masjid,
            'id_pengurus' => $pengurus_masjid->id_pengurus
        ]);
        $delete_muzakki = Muzakki_Masjid::where('id_zakat', $id_zakat)->delete();
        $muzakki = Muzakki_Masjid::where('id_zakat', $id_zakat)->get();
        return view('pengurus.edit_muzakki', ['id_zakat' => $request->id_zakat, 'jml_muzakki' => $request->jml_muzakki, 'muzakki' => $muzakki])->with('status', 'Data berhasil disimpan');
    }

    public function delete_zakat_masjid($id_zakat)
    {
        Zakat_Fitrah_Masjid::where('id_zakat', $id_zakat)->delete();
        return redirect(route('pengurus.zakat_masjid'))->with('status', 'Data berhasil dihapus');
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

    public function edit_pengeluaran($id_pengeluaran)
    {
        $pengeluaran = Kas_Keluar::where('id_pengeluaran', $id_pengeluaran)->first();
        return view('pengurus.edit_pengeluaran', compact('pengeluaran'));
    }
    
    public function update_pengeluaran(Request $request, $id_pengeluaran)
    {
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        Kas_Keluar::where('id_pengeluaran', $id_pengeluaran)->update([
            'tgl_pengeluaran' => $request->tgl_pengeluaran,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'id_pengurus' => $pengurus->id_pengurus,
            'id_masjid' => $pengurus->id_masjid
        ]);
        return redirect(route('pengurus.pengeluaran'))->with('status', 'Data berhasil diperbarui');
    }

    public function delete_pengeluaran($id_pengeluaran)
    {
        Kas_Keluar::where('id_pengeluaran', $id_pengeluaran)->delete();
        return redirect(route('pengurus.pengeluaran'))->with('status', 'Data berhasil dihapus');
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

    public function edit_zakat_web($id_zakat)
    {
        $zakat_web = Zakat_Fitrah_Web::where('id_zakat', $id_zakat)->first();
        return view('pengurus.edit_zakat_web', compact('zakat_web'));
    }

    public function detail_zakat_web($id_zakat)
    {
        $zakat_web = Zakat_Fitrah_Web::where('id_zakat', $id_zakat)->first();
        return view('pengurus.detail_zakat_web', compact('zakat_web'));
    }

    public function update_zakat_web(Request $request, $id_zakat)
    {
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        Zakat_Fitrah_Web::where('id_zakat', $id_zakat)
            ->update([
                'status_validasi' => $request->status_validasi,
                'id_pengurus' => $pengurus->id_pengurus
            ]);
        return redirect(route('pengurus.zakat_web_all'))->with('status', 'Data berhasil diubah');
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
        // $sum_infaq_masjid = Infaq_Masjid::selectRaw('SUM(nominal) as total_infaq_masjid')
        //     ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->first();
        // $sum_infaq_v = Infaq_Web::selectRaw('SUM(nominal) as total_infaq_web')
        //     ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 1')->first();
        // $sum_zakat_masjid_beras = Zakat_Fitrah_Masjid::selectRaw('SUM(banyaknya) as total_zakat_masjid_beras')
        //     ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and jenis = 1')->first();
        // $sum_zakat_masjid_uang = Zakat_Fitrah_Masjid::selectRaw('SUM(banyaknya) as total_zakat_masjid_uang')
        //     ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and jenis = 2')->first();
        // $sum_pengeluaran = Kas_Keluar::selectRaw('SUM(nominal) as total_pengeluaran')
        //     ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->first();
        $masjid = Masjid::where('id_masjid', $pengurus->id_masjid)->first();
        if(!empty($pengurus)){
            return view('pengurus.ringkasan', compact('masjid', 'sum_infaq_masjid', 'sum_infaq_v', 'sum_zakat_masjid_beras', 'sum_zakat_masjid_uang', 'sum_pengeluaran'));
        }else{
            return redirect(route('pengurus.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }
    }

    public function list_pengumuman()
    {
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        $announcements = Announcements::where('id_pengurus', $pengurus->id_pengurus)->get();
        return view('pengurus.list_pengumuman', compact('announcements'));
    }

    public function input_pengumuman()
    {
        return view('pengurus.input_pengumuman');
    }

    public function store_pengumuman(Request $request)
    {
        $pengurus = Pengurus::where('id_user', Auth::user()->id)->first();
        $pengumuman = Announcements::create([
            'judul' => $request->judul,
            'isi' => $request->konten,
            'id_pengurus' => $pengurus->id_pengurus
        ]);

        return redirect(route('pengurus.list_pengumuman'))->with('status', 'Data berhasil disimpan');
    }    

    public function detail_pengumuman($id_announcement)
    {
        $announcement = Announcements::where('id_announcement', $id_announcement)->first();
        return view('pengurus.detail_pengumuman', compact('announcement'));
    }

    public function edit_pengumuman($id_announcement)
    {
        $announcement = Announcements::where('id_announcement', $id_announcement)->first();
        return view('pengurus.edit_pengumuman', compact('announcement'));
    }

    public function update_pengumuman(Request $request, $id_announcement)
    {
        Announcements::where('id_announcement', $id_announcement)->update([
            'judul' => $request->judul,
            'isi' => $request->konten,

        ]);
        return redirect(route('pengurus.list_pengumuman'))->with('status', 'Data berhasil diubah');
    }

    public function destroy_pengumuman($id_announcement)
    {
        Announcements::destroy($id_announcement);
        return redirect(route('pengurus.list_pengumuman'))->with('status', 'Data berhasil dihapus');
    }
}
