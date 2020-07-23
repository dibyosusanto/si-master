<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengurus;
use App\Masjid;
use App\Jamaah_Web;
use App\User;
use App\Infaq_Web;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;

class JamaahWebController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('jamaah_web');
    }

    public function index(){
        $user = User::where('id', Auth::user()->id)->first();
        $jamaah_web = Jamaah_Web::where('id_user', Auth::user()->id)->first();
        if(!empty($jamaah_web)){
            return view('jamaah_web.index', compact('jamaah_web'));
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
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);


        $jamaah_web = Jamaah_Web::where('id_user', $id)->first();
        $jamaah_web->nama_jamaah = ucwords($request->get('nama_jamaah'));
        $jamaah_web->no_hp = $request->get('no_hp');
        $jamaah_web->alamat = ucwords($request->get('alamat'));
        $jamaah_web->jenis_kelamin = $request->get('jenis_kelamin');
        $jamaah_web->tgl_lahir = $request->get('tgl_lahir');
        $jamaah_web->save();

        $user = User::find($id);
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect(route('jamaah_web.profile', $id));
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

    public function infaq_web_valid()
    {
        // $user = User::where('id', Auth::user()->id)->first();
        // $jamaah_web = Jamaah_Web::where('id_user', Auth::user()->id)->first();
        // $masjid = DB::table('masjids')->select('*')->get();
        // $infaq_web = Infaq_Web::whereRaw('id_jamaah = (select id_jamaah from jamaah__webs where id_user = '. Auth::user()->id .') and status_validasi = 1')->get();
        return view('jamaah_web.infaq_valid');
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
                return redirect(route('jamaah_web.lihatInfaq'))->with('input', 'Data berhasil diinput!');
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
}