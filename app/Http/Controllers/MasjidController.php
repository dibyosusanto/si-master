<?php

namespace App\Http\Controllers;
use App\Masjid;
use App\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasjidController extends Controller
{
    public function index(){
        $masjid = Masjid::paginate(15);
        $jmlPengurus = DB::table('penguruses')
            ->select('id_pengurus')
            ->groupBy('id_masjid')
            ->count();
        
        return view('masjid.index', compact('masjid', 'jmlPengurus'));
    }

    public function create(){
        return view('masjid.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'nama_masjid' => 'required|string',
            'alamat' => 'required|string',
            'no_rekening' => 'required|integer|unique:masjids,no_rekening'
        ]);

        try{
            $masjid = Masjid::create([
                 'nama_masjid' => ucwords($request->nama_masjid),
                 'alamat' => ucwords($request->alamat),
                 'no_rekening' => $request->no_rekening
            ]);
            return redirect(route('masjid.index'))->with(['success' => $request->nama_masjid .' berhasil ditambahkan!']);
        }catch(\Exception $e){
            return redirect(route('masjid.create'))->with(['error' => $e->getMessage()]);
        }
    }

    public function show($id_masjid){
        $masjid = Masjid::find($id_masjid);
        $mosque = DB::table('masjids')
            ->where('id_masjid', '=', $id_masjid)
            ->select('*')
            ->get();
        $jmlPengurus = DB::table('penguruses')
            ->select('*')
            ->where('id_masjid', '=', $id_masjid)
            ->count();
        $pengurus = DB::table('penguruses')
            // ->join('masjids', 'masjids.id_masjid', '=', 'penguruses.id_masjid')
            ->where('id_masjid', '=', $id_masjid)
            ->select('*')
            ->get();
        $jamaah = DB::table('jamaah__masjids')
            // ->join('masjids', 'masjids.id_masjid', '=', 'jamaah__masjids.id_masjid')
            ->where('id_masjid', '=', $id_masjid)
            ->select('jamaah__masjids.*')
            ->get();
        return view('masjid.show', compact('mosque', 'pengurus', 'jamaah', 'jmlPengurus'));
    }

    public function edit($id_masjid){
        $masjid = Masjid::find($id_masjid);
        return view('masjid.edit', compact('masjid'));
    }

    public function update(Request $request, $id_masjid){
        $masjid = Masjid::find($id_masjid);
        $masjid->nama_masjid = ucwords($request->get('nama_masjid'));
        $masjid->alamat = ucwords($request->get('alamat'));
        $masjid->no_rekening = $request->get('no_rekening');
        $masjid->save();
        return redirect(route('masjid.index'))->with(['success' => $request->nama_masjid . ' berhasil diubah']);
    }
    
    public function destroy(Request $request, $id_masjid){
        $masjid = Masjid::find($id_masjid);
        $masjid->delete();
        return redirect(route('masjid.index'))->with(['status' => $request->nama_masjid . 'Data Berhasil Dihapus']);
    }

}
