<?php

namespace App\Http\Controllers;

use App\User;
use App\Masjid;
use App\Pengurus;
use App\Jamaah_Web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Auth;

class JamaahWebRegisterController extends Controller
{
    protected $redirectTo = '/jamaah_web/';
    
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function getRegister(){
        return view('jamaah_web.daftar');
    }
    
    
    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
            
        ]);
        
            $jamaah_web = User::create([
                 'email' => ($request->email),
                 'password' => bcrypt($request->password),
                 'role' => 3
            ]);
            //echo $pengurus->id;
            return redirect(route('jamaah_web.create', $jamaah_web->id));
        
    }

    public function isidata($id){
        $data['id'] = $id;
        return view('jamaah_web.isidata', $data);
    }

    public function store(Request $request){
        $messages = [
            'required' => ':attribute harus diisi',
        ];
        
        $this->validate($request, [
            'nama_jamaah' => 'required|string|min:3',
            'no_hp' => 'required|numeric|min:11|max:13',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
        ], $messages);
            $pengurus = Jamaah_Web::create([
                'nama_jamaah' => $request->get('nama_jamaah'),
                'no_hp' => $request->get('no_hp'),
                'alamat' => $request->get('alamat'),
                'tgl_lahir' => $request->get('tgl_lahir'),
                'jenis_kelamin' => $request->get('jenis_kelamin'),
                'id_user' => Auth::user()->id
            ]);
            return redirect(route('jamaah_web.index'), ['data' => $request]);
    }
}
