<?php

namespace App\Services;

use App\Models\Aturan;

class AturanService
{
    public function handleStore($data)
    {
        $aturan = Aturan::create([
            'kode' => $data['kode'],
            'mb' => $data['mb'],
            'md' => $data['md'],
            'keputusan_id' => $data['keputusan_id']
        ]);

        return $aturan;
    }
}
