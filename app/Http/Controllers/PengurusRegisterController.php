<?php

namespace App\Http\Controllers;

use App\User;
use App\Masjid;
use App\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Auth;

class PengurusRegisterController extends Controller
{
    protected $redirectTo = '/pengurus/';
    
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function getRegister(){
        return view('pengurus.daftar');
    }
    
    
    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            
        ]);
        
            $pengurus = User::create([
                 'email' => ($request->email),
                 'password' => bcrypt($request->password),
                 'role' => 2
            ]);
            //echo $pengurus->id;
            return redirect(route('pengurus.create',$pengurus->id));
        
    }

    public function isidata($id){
        $data['masjid'] = DB::table('masjids')
            ->select('id_masjid', 'nama_masjid')
            ->get();
        $data['id'] = $id;
        return view('pengurus.isidata', $data);
    }

    public function store(Request $request){
        $this->validate($request, [
            'nama_pengurus' => 'required|string',
            'no_hp' => 'required|numeric',
            'alamat' => 'required',
            'id_masjid' => 'required|string',
        ]);
            $pengurus = Pengurus::create([
                 'nama_pengurus' => ucwords($request->nama_pengurus),
                 'no_hp' => $request->no_hp,
                 'alamat' => ucwords($request->alamat),
                 'id_masjid' => $request->id_masjid,
                 'id_user' => Auth::user()->id
            ]);
            return redirect(route('pengurus.index'));
    }
}
