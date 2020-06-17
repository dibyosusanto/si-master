<?php

namespace App\Http\Controllers;
use App\Masjid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasjidController extends Controller
{
    public function index(){
        $masjid = Masjid::paginate(15);
        return view('masjid.index', compact('masjid'));
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
            ->where('masjids.id_masjid', '=', $id_masjid)
            ->select('masjids.*')
            ->get();
        $pengurus = DB::table('penguruses')
            ->join('masjids', 'masjids.id_masjid', '=', 'penguruses.id_masjid')
            ->where('masjids.id_masjid', '=', $id_masjid)
            ->select('penguruses.*')
            ->get();
        $jamaah = DB::table('jamaah__masjids')
            ->join('masjids', 'masjids.id_masjid', '=', 'jamaah__masjids.id_masjid')
            ->where('masjids.id_masjid', '=', $id_masjid)
            ->select('jamaah__masjids.*')
            ->get();
        return view('masjid.show', compact('mosque', 'pengurus', 'jamaah'));
    }

    public function edit($id_masjid){
        $masjid = Masjid::find($id_masjid);
        return view('masjid.edit', compact('masjid'));
    }

    public function update(Request $request, $id_masjid){
        $masjid = Masjid::find($id_masjid);
        // // Masjid::where('id_masjid', $id_masjid)
        // ->update([
            
        //     // 'nama_masjid'=>ucfirst($request->nama_masjid),
        //     // 'alamat'=>$request->alamat,
        //     // 'no_rekening'=>$request->no_rekening
        // ]);
        $masjid->nama_masjid = $request->get('nama_masjid');
        $masjid->alamat = $request->get('alamat');
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
