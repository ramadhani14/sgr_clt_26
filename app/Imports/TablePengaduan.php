<?php

namespace App\Imports;

use App\Models\MasterTablePengaduan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Auth;
use Carbon\Carbon;


class TablePengaduan implements ToModel , SkipsOnError ,WithStartRow,WithCalculatedFormulas
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
            return new MasterTablePengaduan([
                'kode'     => $kode,
                'nama_file'     => $namafile,
                'file_status'     => $row[0],
                'tanggal_laporan'     => $row[1],
                'nama_pelapor'     => $row[2],
                'pelaku_utama'     => $row[3],
                'judul_laporan'     => $row[4],
                'detail_laporan'     => $row[5],
                'uraian'     => $row[6],
                'status'     => $row[7],
                'no_reg'     => $row[8],
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
