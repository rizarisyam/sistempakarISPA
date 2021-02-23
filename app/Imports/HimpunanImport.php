<?php

namespace App\Imports;

use App\Models\Himpunan;
use Maatwebsite\Excel\Concerns\ToModel;

class HimpunanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Himpunan([
            'variabel_id' => $row[1],
            'nama' => $row[2],
            'domain' => $row[3],
        ]);
    }
}
