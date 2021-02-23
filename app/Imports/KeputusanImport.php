<?php

namespace App\Imports;

use App\Models\Keputusan;
use Maatwebsite\Excel\Concerns\ToModel;

class KeputusanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Keputusan([
            'kode' => $row[1],
            'nama' => $row[2],
            'saran' => $row[3],
        ]);
    }
}
