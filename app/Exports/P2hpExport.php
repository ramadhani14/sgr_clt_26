<?php

namespace App\Exports;

// use App\Models\MasterTableP2hp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
class P2hpExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $data; 

    public function __construct(array $data = [])
    {
        $this->data = $data; 
    }

    public function collection()
    {
        $data = DB::table('master_table_p2hp')
        ->selectRaw('file_status,nama,tahun,pagu_anggaran,kondisi_temuan,kelompok_temuan,nilai_temuan,rekomendasi,nama_pj,jabatan_pj_terperiksa,jenis_audit,no_pkp,ketua_tim,tgl_p2hp,no_surat,ket');

        $datasum = DB::table('master_table_p2hp')
        ->selectRaw('"" as file_status,"" as nama,"" as tahun,"" as pagu_anggaran,"" as kondisi_temuan,"" as kelompok_temuan,SUM(nilai_temuan) as sum_nilai_temuan,"" as rekomendasi,"" as nama_pj,"" as jabatan_pj_terperiksa,"" as jenis_audit,"" as no_pkp,"" as ketua_tim,"" as tgl_p2hp,"" as no_surat,"" as ket');

        if($this->data['f_file_status']){
            $data->where('file_status','LIKE','%'.$this->data['f_file_status'].'%');
            $datasum->where('file_status','LIKE','%'.$this->data['f_file_status'].'%');
        }
        if($this->data['f_nama']){
            $data->where( 'nama', 'LIKE', '%'.$this->data['f_nama'].'%');
            $datasum->where( 'nama', 'LIKE', '%'.$this->data['f_nama'].'%');
        }
        if($this->data['f_tahun']){
            $data->where( 'tahun', 'LIKE', '%'.$this->data['f_tahun'].'%');
            $datasum->where( 'tahun', 'LIKE', '%'.$this->data['f_tahun'].'%');
        }
        if($this->data['f_kelompok_temuan']){
            $data->where( 'kelompok_temuan', 'LIKE', '%'.$this->data['f_kelompok_temuan'].'%');
            $datasum->where( 'kelompok_temuan', 'LIKE', '%'.$this->data['f_kelompok_temuan'].'%');
        }
        if($this->data['f_nama_pj']){
            $data->where( 'nama_pj', 'LIKE', '%'.$this->data['f_nama_pj'].'%');
            $datasum->where( 'nama_pj', 'LIKE', '%'.$this->data['f_nama_pj'].'%');
        }
        if($this->data['f_jenis_audit']){
            $data->where( 'jenis_audit', 'LIKE', '%'.$this->data['f_jenis_audit'].'%');
            $datasum->where( 'jenis_audit', 'LIKE', '%'.$this->data['f_jenis_audit'].'%');
        }
        if($this->data['f_ketua_tim']){
            $data->where( 'ketua_tim', 'LIKE', '%'.$this->data['f_ketua_tim'].'%');
            $datasum->where( 'ketua_tim', 'LIKE', '%'.$this->data['f_ketua_tim'].'%');
        }
        $data = $data->get();
        $datasum = $datasum->get();

        $datafix = $data->concat($datasum);
    
        return $datafix;
    }

    public function headings(): array
    {
        return ["FILE STATUS","NAMA AUDITAN/OPD/DESA","TAHUN ANGGARAN","PAGU ANGGARAN YANG DIAWASI","KONDISI (TEMUAN)","KELOMPOK TEMUAN","NILAI TEMUAN","(CALON/RENCANA) REKOMENDASI","NAMA PENANGGUNG JAWAB (PJ) PENGEMBALIAN","JABATAN PJ PENGEMBALIAN DALAM TAHUN ANGGARAN TERPERIKSA","JENIS AUDIT/REVIU/EVALUASI","No. PKP","KETUA TIM","TANGGAL P2HP","NOMOR SURAT TUGAS","ETERANGAN LAIN DAN LINK FILE PENDUKUNG"];
    }

}
