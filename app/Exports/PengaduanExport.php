<?php

namespace App\Exports;

// use App\Models\MasterTablePengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
class PengaduanExport implements FromCollection, WithHeadings
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
        $data = DB::table('master_table_pengaduan')
        ->selectRaw('file_status,tanggal_laporan,nama_pelapor,pelaku_utama,judul_laporan,detail_laporan,uraian,status,no_reg');

        if($this->data['f_file_status']){
            $data->where('file_status','LIKE','%'.$this->data['f_file_status'].'%');
        }
        if($this->data['f_nama_pelapor']){
            $data->where( 'nama_pelapor', 'LIKE', '%'.$this->data['f_nama_pelapor'].'%');
        }
        if($this->data['f_status']){
            $data->where( 'status', 'LIKE', '%'.$this->data['f_status'].'%');
        }
      
        $data = $data->get();
    
        return $data;
    }

    public function headings(): array
    {
        return ["FILE STATUS","TANGGAL LAPORAN","NAMA PELAPOR","PELAKU UTAMA DAN PIHAK LAIN TERLIBAT YANG DILAPORKAN","JUDUL LAPORAN","DETAIL LAPORAN","URAIAN UPAYA TINDAKLANJUT","STATUS (SELESAI/PROSES/DITOLAK)","NO REG LAPORAN"];
    }

}
