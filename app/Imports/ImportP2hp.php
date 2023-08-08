<?php

namespace App\Imports;


use App\Imports\TableP2hp;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class ImportP2hp implements WithMultipleSheets ,SkipsUnknownSheets
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
        $data['sheet']=2;
        return [
            new TableP2hp($data),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}