<?php

namespace App\Imports;


use App\Imports\TablePengaduan;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class ImportPengaduan implements WithMultipleSheets ,SkipsUnknownSheets
{

    private $data; 

    public function __construct(array $data = [])
    {
        $this->data = $data; 
    }

    public function sheets(): array
    {
        $namafile = $this->data['nama_file'];
        $kode = $this->data['kode'];
        $data['nama_file']=$namafile;
        $data['kode']=$kode;
        $data['sheet']=0;
        return [
            0 => new TablePengaduan($data),
        ];
        // return [
        //     new TablePengaduan($data),
        // ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}