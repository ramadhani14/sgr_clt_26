<?php

namespace App\Imports;


use App\Imports\TableLhp;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class ImportLhp implements WithMultipleSheets ,SkipsUnknownSheets
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
        $data['sheet']=1;
        return [
            new TableLhp($data),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}