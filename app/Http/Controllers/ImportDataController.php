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
use App\Exports\LhpExport;
use App\Exports\P2hpExport;
use App\Exports\PengaduanExport;
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
        $filter = false;

        $data = MasterTableLhp::where('id','<>','~');

        if($request->f_file_status){
            $data->where('file_status','LIKE','%'.$request->f_file_status.'%');
            $filter = true;
        }
        if($request->f_nama){
            $data->where( 'nama', 'LIKE', '%'.$request->f_nama.'%');
            $filter = true;
        }
        if($request->f_tahun){
            $data->where( 'tahun', 'LIKE', '%'.$request->f_tahun.'%');
            $filter = true;
        }
        if($request->f_kelompok_temuan){
            $data->where( 'kelompok_temuan', 'LIKE', '%'.$request->f_kelompok_temuan.'%');
            $filter = true;
        }
        if($request->f_nama_pj){
            $data->where( 'nama_pj', 'LIKE', '%'.$request->f_nama_pj.'%');
            $filter = true;
        }
        if($request->f_jenis_audit){
            $data->where( 'jenis_audit', 'LIKE', '%'.$request->f_jenis_audit.'%');
            $filter = true;
        }
        if($request->f_ketua_tim){
            $data->where( 'ketua_tim', 'LIKE', '%'.$request->f_ketua_tim.'%');
            $filter = true;
        }
        if($request->f_no_lhp){
            $data->where( 'no_lhp', 'LIKE', '%'.$request->f_no_lhp.'%');
            $filter = true;
        }
        $data = $data->get();

        $data_param = [
            'menu','submenu','data','filter'
        ];
        return view('master/datalhp')->with(compact($data_param));
    }

    public function downloadlhp(Request $request)
    {
        $data = [
            'f_file_status' => $request->f_file_status ?: null, 
            'f_nama'    => $request->f_nama ?: null,
            'f_tahun'    => $request->f_tahun ?: null,
            'f_kelompok_temuan'    => $request->f_kelompok_temuan ?: null,
            'f_nama_pj'    => $request->f_nama_pj ?: null,
            'f_jenis_audit'    => $request->f_jenis_audit ?: null,
            'f_ketua_tim'    => $request->f_ketua_tim ?: null,
            'f_no_lhp'    => $request->f_no_lhp ?: null,
        ];
       
        return Excel::download(new LhpExport($data), 'Data_LHP.xlsx');
    }

    public function indexp2hp(Request $request)
    {
        $menu = 'master';
        $submenu='datap2hp';
        $filter = false;

        $data = MasterTableP2hp::where('id','<>','~');
            
        if($request->f_file_status){
            $data->where('file_status','LIKE','%'.$request->f_file_status.'%');
            $filter = true;
        }
        if($request->f_nama){
            $data->where( 'nama', 'LIKE', '%'.$request->f_nama.'%');
            $filter = true;
        }
        if($request->f_tahun){
            $data->where( 'tahun', 'LIKE', '%'.$request->f_tahun.'%');
            $filter = true;
        }
        if($request->f_kelompok_temuan){
            $data->where( 'kelompok_temuan', 'LIKE', '%'.$request->f_kelompok_temuan.'%');
            $filter = true;
        }
        if($request->f_nama_pj){
            $data->where( 'nama_pj', 'LIKE', '%'.$request->f_nama_pj.'%');
            $filter = true;
        }
        if($request->f_jenis_audit){
            $data->where( 'jenis_audit', 'LIKE', '%'.$request->f_jenis_audit.'%');
            $filter = true;
        }
        if($request->f_ketua_tim){
            $data->where( 'ketua_tim', 'LIKE', '%'.$request->f_ketua_tim.'%');
            $filter = true;
        }

        $data = $data->get();
        
        $data_param = [
            'menu','submenu','data','filter'
        ];
        return view('master/datap2hp')->with(compact($data_param));
    }

    public function downloadp2hp(Request $request)
    {
        $data = [
            'f_file_status' => $request->f_file_status ?: null, 
            'f_nama'    => $request->f_nama ?: null,
            'f_tahun'    => $request->f_tahun ?: null,
            'f_kelompok_temuan'    => $request->f_kelompok_temuan ?: null,
            'f_nama_pj'    => $request->f_nama_pj ?: null,
            'f_jenis_audit'    => $request->f_jenis_audit ?: null,
            'f_ketua_tim'    => $request->f_ketua_tim ?: null,
        ];
       
        return Excel::download(new P2hpExport($data), 'Data_P2HP.xlsx');
    }
    public function indexpengaduan(Request $request)
    {
        $menu = 'master';
        $submenu='datapengaduan';
        $filter = false;

        $data = MasterTablePengaduan::where('id','<>','~');
            
        if($request->f_file_status){
            $data->where('file_status','LIKE','%'.$request->f_file_status.'%');
            $filter = true;
        }

        if($request->f_nama_pelapor){
            $data->where( 'nama_pelapor', 'LIKE', '%'.$request->f_nama_pelapor.'%');
            $filter = true;
        }
        if($request->f_status){
            $data->where( 'status', 'LIKE', '%'.$request->f_status.'%');
            $filter = true;
        }

        $data = $data->get();

        $data_param = [
            'menu','submenu','data','filter'
        ];
        return view('master/datapengaduan')->with(compact($data_param));
    }

    public function downloadpengaduan(Request $request)
    {
        $data = [
            'f_file_status' => $request->f_file_status ?: null, 
            'f_nama_pelapor'    => $request->f_nama_pelapor ?: null,
            'f_status'    => $request->f_status ?: null
        ];
       
        return Excel::download(new PengaduanExport($data), 'Data_Pengaduan.xlsx');
    }

    public function storelhp(Request $request)
    {
        $data['file_status'] = $request->file_status_add;
        $data['nama'] = $request->nama_add;
        $data['tahun'] = $request->tahun_add;
        $data['pagu_anggaran'] = $request->pagu_anggaran_add;
        $data['kondisi_temuan'] = $request->kondisi_temuan_add;
        $data['kelompok_temuan'] = $request->kelompok_temuan_add;
        $data['nilai_temuan'] = $request->nilai_temuan_add;
        $data['rekomendasi'] = $request->rekomendasi_add;
        $data['nama_pj'] = $request->nama_pj_add;
        $data['jabatan_pj_terperiksa'] = $request->jabatan_pj_terperiksa_add;
        $data['jabatan_pj_saat_ini'] = $request->jabatan_pj_saat_ini_add;
        $data['catatan'] = $request->catatan_add;
        $data['no_sktjm'] = $request->no_sktjm_add;
        $data['update_tl'] = $request->update_tl_add;
        $data['sisa_temuan'] = $request->sisa_temuan_add;
        $data['kategori'] = $request->kategori_add;
        $data['jenis_audit'] = $request->jenis_audit_add;
        $data['ketua_tim'] = $request->ketua_tim_add;
        $data['no_lhp'] = $request->no_lhp_add;
        $data['tgl_lhp'] = $request->tgl_lhp_add;
        $data['ket'] = $request->ket_add;
        $data['created_by'] = Auth::id();
        $data['created_at'] = Carbon::now()->toDateTimeString();
        $createdata = MasterTableLhp::create($data);
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

    public function storep2hp(Request $request)
    {
        $data['file_status'] = $request->file_status_add;
        $data['nama'] = $request->nama_add;
        $data['tahun'] = $request->tahun_add;
        $data['pagu_anggaran'] = $request->pagu_anggaran_add;
        $data['kondisi_temuan'] = $request->kondisi_temuan_add;
        $data['kelompok_temuan'] = $request->kelompok_temuan_add;
        $data['nilai_temuan'] = $request->nilai_temuan_add;
        $data['rekomendasi'] = $request->rekomendasi_add;
        $data['nama_pj'] = $request->nama_pj_add;
        $data['jabatan_pj_terperiksa'] = $request->jabatan_pj_terperiksa_add;
        $data['jenis_audit'] = $request->jenis_audit_add;
        $data['no_pkp'] = $request->no_pkp_add;
        $data['ketua_tim'] = $request->ketua_tim_add;
        $data['tgl_p2hp'] = $request->tgl_p2hp_add;
        $data['no_surat'] = $request->no_surat_add;
        $data['ket'] = $request->ket_add;
        $data['created_by'] = Auth::id();
        $data['created_at'] = Carbon::now()->toDateTimeString();
        $createdata = MasterTableP2hp::create($data);
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

    public function storepengaduan(Request $request)
    {
        $data['file_status'] = $request->file_status_add;
        $data['tanggal_laporan'] = $request->tanggal_laporan_add;
        $data['nama_pelapor'] = $request->nama_pelapor_add;
        $data['pelaku_utama'] = $request->pelaku_utama_add;
        $data['judul_laporan'] = $request->judul_laporan_add;
        $data['detail_laporan'] = $request->detail_laporan_add;
        $data['uraian'] = $request->uraian_add;
        $data['status'] = $request->status_add;
        $data['no_reg'] = $request->no_reg_add;
        $data['created_by'] = Auth::id();
        $data['created_at'] = Carbon::now()->toDateTimeString();
        $createdata = MasterTablePengaduan::create($data);
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
