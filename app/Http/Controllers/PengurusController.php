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
        return redirect(route('pengurus.profile', $id));
    }

    public function index()
    {
        $jmlJamaahMjd = DB::table('jamaah__masjids')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')
            ->count();
        $jml_infaq_web = DB::table('infaq__webs')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 0')
            ->count();
        return view('pengurus.index', compact('jmlJamaahMjd', 'jml_infaq_web'));
    }

    public function lihatJamaah(){
        $jamaah = DB::table('jamaah__masjids')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        return view('pengurus.lihatJamaah', compact('jamaah'));
            
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

        return redirect(route('pengurus.lihatJamaah'))->with('tambah', $jamaah_masjid->nama_jamaah  . ' berhasil ditambahkan!');
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
        return redirect(route('pengurus.lihatJamaah'))->with('edit', $jamaah_masjid->nama_jamaah  . ' berhasil diedit!');
    }


    public function jamaah_masjid_destroy(Request $request, $id_jamaah){
        $jamaah_masjid= Jamaah_Masjid::find($id_jamaah);
        $jamaah_masjid->delete();
        return redirect(route('pengurus.lihatJamaah'))->with('sukses', $jamaah_masjid->nama_jamaah  . ' berhasil dihapus!');
    }

    public function infaq_web_all(){
        $infaq_web_all = Infaq_Web::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        $sum_infaq_v = Infaq_Web::selectRaw('SUM(nominal) as total_infaq')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 1')->first();
        $sum_infaq = Infaq_Web::selectRaw('SUM(nominal) as total_infaq')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 0')->first();
        return view('pengurus.infaq_web_all', compact('infaq_web_all', 'sum_infaq_v', 'sum_infaq'));
    }
    
    public function validasiInfaq(Request $request, $id){
        Infaq_Web::where('id_infaq', $id)
            ->update(['status_validasi' => 1]);
        return redirect(route('pengurus.infaq_web_all'));
    }

    public function infaq_web_valid()
    {
        $infaq_web_valid = Infaq_Web::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 1')->get();
        $sum_infaq_v = Infaq_Web::selectRaw('SUM(nominal) as total_infaq')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 1')->first();
        return view('pengurus.infaq_valid', compact('infaq_web_valid', 'sum_infaq_v'));
    }

    public function infaq_web_belum_valid()
    {
        $infaq_web_belum_valid = Infaq_Web::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 0')->get();
        $sum_infaq = Infaq_Web::selectRaw('SUM(nominal) as total_infaq')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .') and status_validasi = 0')->first();
        return view('pengurus.infaq_belum_valid', compact('infaq_web_belum_valid', 'sum_infaq'));
    }

    public function infaq_masjid(){
        $infaq_masjids = Infaq_Masjid::whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        $jamaah_masjid = DB::table('jamaah__masjids')
            ->whereRaw('id_masjid = (select penguruses.id_masjid from penguruses where penguruses.id_user =  '. Auth::user()->id .')')->get();
        return view('pengurus.infaq_masjid', compact('infaq_masjids', 'jamaah_masjid'));
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

        return redirect(route('pengurus.infaq_masjid'));
    }
}
