<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengurus;
use App\Masjid;
use App\Jamaah_Web;
use App\User;
use App\Infaq_Web;
use App\Zakat_Fitrah_Web;
use App\Muzakki_Web;
use App\Announcements;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;

class JamaahWebController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['jamaah_web', 'verified']);
    }

    public function index(){
        $user = User::where('id', Auth::user()->id)->first();
        $masjids = Masjid::where('status_validasi', 1)->get();
        $jamaah_web = Jamaah_Web::where('id_user', Auth::user()->id)->first();
        $announcements = Announcements::where('publish', 1)->orderBy('created_at')->paginate(5);
        if(!empty($jamaah_web)){
            return view('jamaah_web.index', compact('jamaah_web', 'announcements', 'masjids'));
        }else{
            return redirect(route('jamaah_web.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }
    }

    public function profile($id)
    {
        $user = User::find($id);
        if(!empty($jamaah_web = Jamaah_Web::where('id_user', $id)->first())){
            return view('jamaah_web.profile', compact('user', 'jamaah_web'));
        }else{
            return redirect(route('jamaah_web.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri telebih dahulu!');
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_jamaah' => 'required|string',
            'no_hp' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
        ]);


        $jamaah_web = Jamaah_Web::where('id_user', $id)->first();
        $jamaah_web->nama_jamaah = ucwords($request->get('nama_jamaah'));
        $jamaah_web->no_hp = $request->get('no_hp');
        $jamaah_web->alamat = ucwords($request->get('alamat'));
        $jamaah_web->jenis_kelamin = $request->get('jenis_kelamin');
        $jamaah_web->tgl_lahir = $request->get('tgl_lahir');
        $jamaah_web->save();


        return redirect(route('jamaah_web.profile', $id))->with('status', 'Data berhasil diperbarui');
    }

    public function lihatInfaq()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $jamaah_web = Jamaah_Web::where('id_user', Auth::user()->id)->first();
        $masjid = DB::table('masjids')->select('*')->get();
        $infaq_web = Infaq_Web::whereRaw('id_jamaah = (select id_jamaah from jamaah__webs where id_user = '. Auth::user()->id .')')->get();
        if(!empty($jamaah_web)){
            return view('jamaah_web.infaq', compact('jamaah_web', 'infaq_web', 'masjid'));
        }else{
            return redirect(route('jamaah_web.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }   
    }

    public function valid_infaq(){
        $user = User::where('id', Auth::user()->id)->first();
        $jamaah_web = Jamaah_Web::where('id_user', Auth::user()->id)->first();
        $masjid = DB::table('masjids')->select('*')->get();
        $infaq_web = Infaq_Web::whereRaw('id_jamaah = (select id_jamaah from jamaah__webs where id_user = '. Auth::user()->id .') and status_validasi = 1')->get();
        if(!empty($jamaah_web)){
            return view('jamaah_web.valid_infaq', compact('jamaah_web', 'infaq_web', 'masjid'));
        }else{
            return redirect(route('jamaah_web.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }   
    }

    public function infaq_belum_valid()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $jamaah_web = Jamaah_Web::where('id_user', Auth::user()->id)->first();
        $masjid = DB::table('masjids')->select('*')->get();
        $infaq_web = Infaq_Web::whereRaw('id_jamaah = (select id_jamaah from jamaah__webs where id_user = '. Auth::user()->id .') and status_validasi = 0')->get();
        if(!empty($jamaah_web)){
            return view('jamaah_web.valid_infaq', compact('jamaah_web', 'infaq_web', 'masjid'));
        }else{
            return redirect(route('jamaah_web.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }
    }

    public function inputInfaq(Request $request){
        $jamaah_web = DB::table('jamaah__webs')
            ->select('*')
            ->where('id_user', '=', Auth::user()->id)
            ->first();
        $user = User::where('id', Auth::user()->id)->first();
        if(!empty($jamaah_web)){
            $this->validate($request, [
                'tgl_infaq' => 'required',
                'bukti_infaq' => 'required|image|mimes:png,jpeg,jpg',
                'nominal' => 'required|integer',
                'id_masjid' => 'required',
            ]);        
            if($request->hasFile('bukti_infaq')){
                //menyimpan sementara ke dalam variabel file
                $file = $request->file('bukti_infaq');
                //ubah nama file
                $filename = $jamaah_web->nama_jamaah . '-' . $request->tgl_infaq . '-'. $request->id_masjid . '.' . $file->getClientOriginalExtension();
                //simpan file
                $file->storeAs('public/bukti_infaq_web', $filename);
                //input data
                $input_infaq_web = Infaq_Web::create([
                    'tgl_infaq' => $request->tgl_infaq,
                    'keterangan' => $request->keterangan,
                    'bukti_infaq' => $filename,
                    'nominal' => $request->nominal,
                    'id_masjid' => $request->id_masjid,
                    'id_jamaah' => $jamaah_web->id_jamaah
                ]);
                return redirect(route('jamaah_web.lihatInfaq'))->with('status', 'Data berhasil diinput!');
            }    
        }else{
            return redirect(route('jamaah_web.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }
    }

    public function detail_infaq($id)
    {
        $jamaah_web = Jamaah_Web::where('id_user', '=', Auth::user()->id)->first();
        $detail_infaqs = Infaq_Web::where('id_infaq', $id)->get();
        return view('jamaah_web.detail_infaq', compact('detail_infaqs', 'jamaah_web'));
    }

    public function zakat()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $jamaah_web = Jamaah_Web::where('id_user', Auth::user()->id)->first();
        $masjid = DB::table('masjids')->select('*')->get();
        $zakat_web = Zakat_Fitrah_Web::whereRaw('id_jamaah = (select id_jamaah from jamaah__webs where id_user = '. Auth::user()->id .')')->get();
        if(!empty($jamaah_web)){
            return view('jamaah_web.zakat', compact('jamaah_web', 'zakat_web', 'masjid'));
        }else{
            return redirect(route('jamaah_web.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }   
    }

    public function input_zakat(Request $request)
    {
        $jamaah_web = Jamaah_Web::where('id_user', '=', Auth::user()->id)->first();
        $user = User::where('id', Auth::user()->id)->first();
        if(!empty($jamaah_web)){
            // $this->validate($request, [
            //     'tgl_zakat' => 'required',
            //     'bukti_zakat' => 'required|image|mimes:png,jpeg,jpg',
            //     'jml_muzakki' => 'required',
            //     'nominal' => 'required|integer',
            //     'id_masjid' => 'required'
            // ]);        
            if($request->hasFile('bukti_zakat')){
                //menyimpan sementara ke dalam variabel file
                $file = $request->file('bukti_zakat');
                //ubah nama file
                $filename = $jamaah_web->nama_jamaah . '-' . $request->tgl_zakat . '-'. $request->id_masjid . '.' . $file->getClientOriginalExtension();
                //simpan file
                $file->storeAs('public/bukti_zakat_web', $filename);
                //input data
                $zakat = Zakat_Fitrah_Web::create([
                    'tgl_zakat' => $request->tgl_zakat,
                    'keterangan' => $request->keterangan,
                    'bukti_zakat' => $filename,
                    'nominal' => $request->banyaknya,
                    'jml_muzakki' => $request->jml_muzakki,
                    'id_masjid' => $request->id_masjid,
                    'id_jamaah' => $jamaah_web->id_jamaah
                ]);
                return view('jamaah_web.input_muzakki', ['id_zakat' => $zakat->id_zakat, 'jml_muzakki' => $zakat->jml_muzakki])->with('status', 'Data berhasil disimpan');
            }    
        }else{
            return redirect(route('jamaah_web.create', $user->id))->with('lengkapi', 'Mohon lengkapi data diri terlebih dahulu!');
        }
    }

    public function store_muzakki(Request $request)
    {
        $nama_muzakki = $request->nama_muzakki;
        foreach($nama_muzakki as $key => $no){
            $input['nama_muzakki'] = $nama_muzakki[$key];
            $input['id_zakat'] = $request->id_zakat;
            Muzakki_Web::create($input);
        }
        return redirect(route('jamaah_web.zakat'))->with('status', 'Data zakat berhasil disimpan');
    }

    public function detail_zakat($id_zakat)
    {
        $jamaah_web = Jamaah_Web::where('id_user', '=', Auth::user()->id)->first();
        $detail_zakat = Zakat_Fitrah_Web::where('id_zakat', $id_zakat)->first();
        return view('jamaah_web.detail_zakat', compact('jamaah_web', 'detail_zakat'));
    }

    public function detail_masjid($id_masjid)
    {
        $masjid = Masjid::where('id_masjid', $id_masjid)->first();
        return view('jamaah_web.detail_masjid', compact('masjid'));
    }

    public function detail_pengumuman($id_announcement)
    {
        $announcement = Announcements::where('id_announcement', $id_announcement)->first();
        return view('jamaah_web.detail_pengumuman', compact('announcement'));
    }

    public function edit_kata_sandi()
   {
       $user = User::where('id', Auth::user()->id)->first();
       return view('jamaah_web.edit_kata_sandi');
   } 
   
   public function update_kata_sandi(Request $request, $id_user)
   {
        $user = User::where('id', $id_user)->first();
        if(!Hash::check($request->password, $user->password)){
            return redirect(route('jamaah_web.edit_kata_sandi'))->with('alert', 'Password lama salah');
        }
        if($request->password_baru != $request->konfir_password){
            return redirect(route('jamaah_web.edit_kata_sandi'))->with('alert', 'Password baru dan konfirmasi tidak sama');
        }
        $ubah = User::where('id', $id_user)->update([
            'password' => Hash::make($request->password_baru)
        ]);
        return redirect(route('jamaah_web.edit_kata_sandi'))->with('status', 'Password berhasil diubah');
   }
}
