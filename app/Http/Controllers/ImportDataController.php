<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MasterTableLhp;
use App\Models\MasterTableP2hp;
use App\Models\MasterTablePengaduan;
use App\Imports\ImportLhp;
use App\Imports\ImportP2hp;
use App\Imports\ImportPengaduan;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Crypt;

class ImportDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexlhp(Request $request)
    {
        $menu = 'master';
        $submenu='datalhp';

        $data = MasterTableLhp::where('id','<>','~');
            
        if($request->f_file_status){
            $data->where('file_status','LIKE','%'.$request->f_file_status.'%');
        }
        if($request->f_nama){
            $data->where( 'nama', 'LIKE', '%'.$request->f_nama.'%');
        }
        $data = $data->get();

        $data_param = [
            'menu','submenu','data'
        ];
        return view('master/datalhp')->with(compact($data_param));
    }

    public function indexp2hp()
    {
        $menu = 'master';
        $submenu='datap2hp';
        $data = MasterTableP2hp::all();
        $data_param = [
            'menu','submenu','data'
        ];
        return view('master/datap2hp')->with(compact($data_param));
    }
    public function indexpengaduan()
    {
        $menu = 'master';
        $submenu='datapengaduan';
        $data = MasterTablePengaduan::all();
        $data_param = [
            'menu','submenu','data'
        ];
        return view('master/datapengaduan')->with(compact($data_param));
    }

    public function store(Request $request)
    {
        $data['fk_kategori_soal'] = $request->fk_kategori_soal_add;
        $data['soal'] = $request->soal_add;
        // $data['tingkat'] = $request->tingkat_add;
        $data['a'] = $request->a_add;
        $data['b'] = $request->b_add;
        $data['c'] = $request->c_add;
        $data['d'] = $request->d_add;
        $data['e'] = $request->e_add;
        $data['point_a'] = $request->point_a_add;
        $data['point_b'] = $request->point_b_add;
        $data['point_c'] = $request->point_c_add;
        $data['point_d'] = $request->point_d_add;
        $data['point_e'] = $request->point_e_add;
        $data['jawaban'] = $request->jawaban_add;

        $data['pembahasan'] = $request->pembahasan_add;

        // if ($data['soal']=='' || $data['a']=='' || $data['b']=='' || $data['c']=='' || $data['d']=='' || $data['e']=='' || $data['jawaban']=='' || $data['pembahasan']=='') {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Semua kolom harus diisi!'
        //     ]);
        //     exit();
        // }

        $data['created_by'] = Auth::id();
        $data['created_at'] = Carbon::now()->toDateTimeString();
        $data['updated_by'] = Auth::id();
        $data['updated_at'] = Carbon::now()->toDateTimeString();
        $createdata = MasterSoal::create($data);
        if($createdata){
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menambahkan data'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Gagal. Mohon coba kembali!'
            ]);
        }
    }

    public function edit($idkategori,$iddata)
    {
        $menu = 'master';
        $submenu='kategorisoal';
        $data = MasterSoal::find($iddata);
        $datakategori = KategoriSoal::find($idkategori);
        $data_param = [
            'menu','submenu','data','idkategori','datakategori'
        ];

        return view('master/editsoal')->with(compact($data_param));
    }

    public function updatelhp(Request $request)
    {
        $id = $request->iddata[0];
        $data['catatan'] = $request->catatan[0];
        $data['no_sktjm'] = $request->no_sktjm[0];
        $data['update_tl'] = rupiahToDb($request->update_tl[0]);
        $data['sisa_temuan'] = rupiahToDb($request->sisa_temuan[0]);
        $data['ket'] = $request->ket[0];
        $data['updated_by'] = Auth::id();
        $data['updated_at'] = Carbon::now()->toDateTimeString();

        $updatedata = MasterTableLhp::find($id)->update($data);

        if($updatedata){
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Gagal. Mohon coba kembali!'
            ]);
        }
    }

    public function updatep2hp(Request $request)
    {
        $id = $request->iddata[0];
        $data['ket'] = $request->ket[0];
        $data['updated_by'] = Auth::id();
        $data['updated_at'] = Carbon::now()->toDateTimeString();

        $updatedata = MasterTableP2hp::find($id)->update($data);

        if($updatedata){
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Gagal. Mohon coba kembali!'
            ]);
        }
    }

    public function destroy($id)
    {
        $data['deleted_by'] = Auth::id();
        $data['deleted_at'] = Carbon::now()->toDateTimeString();
        $updateData = MasterSoal::find($id)->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }

    public function importlhp(Request $request)
    {
        if ($files = $request->file("fileexcel")) {
            $namafile = $files->getClientOriginalName();
        }

        $kode = time();
        // $kode = 1686825210;
        
        $data = [
            'nama_file' => $namafile, 
            'kode'    => $kode
        ]; 
        
        Excel::import(new ImportLhp($data), request()->file('fileexcel'));

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diimport'
        ]);
    }

    public function importp2hp(Request $request)
    {
        if ($files = $request->file("fileexcel")) {
            $namafile = $files->getClientOriginalName();
        }

        $kode = time();
        // $kode = 1686825210;
        
        $data = [
            'nama_file' => $namafile, 
            'kode'    => $kode
        ]; 
        
        Excel::import(new ImportP2hp($data), request()->file('fileexcel'));

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diimport'
        ]);
    }

    public function importpengaduan(Request $request)
    {
        if ($files = $request->file("fileexcel")) {
            $namafile = $files->getClientOriginalName();
        }

        $kode = time();
        // $kode = 1686825210;
        
        $data = [
            'nama_file' => $namafile, 
            'kode'    => $kode
        ]; 
        
        Excel::import(new ImportPengaduan($data), request()->file('fileexcel'));

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diimport'
        ]);
    }

    public function destroylhpall(Request $request)
    {
        foreach($request->iddata as $key){
            MasterTableLhp::find($key)->forceDelete();
        }
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }

    public function destroypengaduanall(Request $request)
    {
        foreach($request->iddata as $key){
            MasterTablePengaduan::find($key)->forceDelete();
        }
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }

    public function destroyp2hpall(Request $request)
    {
        foreach($request->iddata as $key){
            MasterTableP2hp::find($key)->forceDelete();
        }
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
