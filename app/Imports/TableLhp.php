<?php

namespace App\Imports;

use App\Models\MasterTableLhp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Auth;
use Carbon\Carbon;



class TableLhp implements ToModel , SkipsOnError ,WithStartRow,WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $data; 

    public function __construct(array $data = [])
    {
        $this->data = $data; 
    }

    public function model(array $row)
    {
        $namafile = $this->data['nama_file'];
        $kode = $this->data['kode'];
        $sheet = $this->data['sheet'];
            return new MasterTableLhp([
                'kode'     => $kode,
                'nama_file'     => $namafile,
                'file_status'     => $row[0],
                'nama'     => $row[1],
                'tahun'     => $row[2],
                'pagu_anggaran'     => $row[3],
                'kondisi_temuan'     => $row[4],
                'kelompok_temuan'     => $row[5],
                'nilai_temuan'     => $row[6],
                'rekomendasi'     => $row[7],
                'nama_pj'     => $row[8],
                'jabatan_pj_terperiksa'     => $row[9],
                'jabatan_pj_saat_ini'     => $row[10],
                'catatan'     => $row[11],
                'no_sktjm'     => $row[12],
                'update_tl'     => $row[13],
                'sisa_temuan'     => $row[14],
                'kategori'     => $row[15],
                'jenis_audit'     => $row[16],
                'ketua_tim'     => $row[17],
                'no_lhp'     => $row[18],
                'tgl_lhp'     => $row[19],
                'ket'     => $row[20],
                'created_by'    => Auth::id(), 
                'created_at'    => Carbon::now()->toDateTimeString(),
                'updated_by'    => Auth::id(), 
                'updated_at'    => Carbon::now()->toDateTimeString(),  
            ]);
        // }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function onError(\Throwable $error)
    {
        // Handle the exception how you'd like.
    }
}
