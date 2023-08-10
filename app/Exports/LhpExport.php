<?php

namespace App\Exports;

// use App\Models\MasterTableLhp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
class LhpExport implements FromCollection, WithHeadings
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
        $data = DB::table('master_table_lhp')
        ->selectRaw('file_status,nama,tahun,pagu_anggaran,kondisi_temuan,kelompok_temuan,nilai_temuan,rekomendasi,nama_pj,jabatan_pj_terperiksa,jabatan_pj_saat_ini,catatan,no_sktjm,update_tl,sisa_temuan,kategori,jenis_audit,ketua_tim,no_lhp,tgl_lhp,ket');

        $datasum = DB::table('master_table_lhp')
        ->selectRaw('"" as file_status,"" as nama,"" as tahun,"" as pagu_anggaran,"" as kondisi_temuan,"" as kelompok_temuan,SUM(nilai_temuan) as sum_nilai_temuan,"" as rekomendasi,"" as nama_pj,"" as jabatan_pj_terperiksa,"" as jabatan_pj_saat_ini,"" as catatan,"" as no_sktjm,"" as update_tl,SUM(sisa_temuan) as sum_sisa_temuan,"" as kategori,"" as jenis_audit,"" as ketua_tim,"" as no_lhp,"" as tgl_lhp,"" as ket');

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
        if($this->data['f_jenis_audit']){
            $data->where( 'jenis_audit', 'LIKE', '%'.$this->data['f_jenis_audit'].'%');
            $datasum->where( 'jenis_audit', 'LIKE', '%'.$this->data['f_jenis_audit'].'%');
        }
        if($this->data['f_ketua_tim']){
            $data->where( 'ketua_tim', 'LIKE', '%'.$this->data['f_ketua_tim'].'%');
            $datasum->where( 'ketua_tim', 'LIKE', '%'.$this->data['f_ketua_tim'].'%');
        }
        if($this->data['f_no_lhp']){
            $data->where( 'no_lhp', 'LIKE', '%'.$this->data['f_no_lhp'].'%');
            $datasum->where( 'no_lhp', 'LIKE', '%'.$this->data['f_no_lhp'].'%');
        }
        $data = $data->get();
        $datasum = $datasum->get();

        $datafix = $data->concat($datasum);
    
        return $datafix;
    }

    public function headings(): array
    {
        return ["FILE STATUS","NAMA AUDITAN/OPD/DESA","TAHUN ANGGARAN","PAGU ANGGARAN YANG DIAWASI","KONDISI (TEMUAN)","KELOMPOK TEMUAN","NILAI TEMUAN","REKOMENDASI","NAMA PENANGGUNG JAWAB (PJ) PENGEMBALIAN","JABATAN PJ PENGEMBALIAN DALAM TAHUN ANGGARAN TERPERIKSA","JABATAN/DOMISILI/KONDISI PJ PENGEMBALIAN SAAT INI","CATATAN TINDAKLANJUT","NO. SKTJM","UPDATE TL/CICILAN","SISA TEMUAN","KATEGORI (TINGKAT KESULITAN PENAGIHAN)","JENIS AUDIT","KETUA TIM","NO LHP","TANGGAL LHP","KETERANGAN LAIN DAN LINK FILE PENDUKUNG","SUM NILAI TEMUAN"];
    }

}
