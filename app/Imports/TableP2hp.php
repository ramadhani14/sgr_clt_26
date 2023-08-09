<?php

namespace App\Imports;

use App\Models\MasterTableP2hp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Auth;
use Carbon\Carbon;


class TableP2hp implements ToModel , SkipsOnError ,WithStartRow,WithCalculatedFormulas
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
            return new MasterTableP2hp([
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
                'jenis_audit'     => $row[10],
                'no_pkp'     => $row[11],
                'ketua_tim'     => $row[12],
                'tgl_p2hp'     => $row[13],
                'no_surat'     => $row[14],
                'ket'     => $row[15],
                'created_by'    => Auth::id(), 
                'created_at'    => Carbon::now()->toDateTimeString(),
                // 'updated_by'    => Auth::id(), 
                // 'updated_at'    => Carbon::now()->toDateTimeString(),  
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
