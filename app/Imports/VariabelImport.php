<?php

namespace App\Imports;

use App\Models\Variabel;
use Maatwebsite\Excel\Concerns\ToModel;

class VariabelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Variabel([
            'kode' => $row[1],
            'nama' => $row[2],
        ]);
    }
}
