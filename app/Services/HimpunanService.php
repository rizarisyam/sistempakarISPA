<?php

namespace App\Services;
use App\Models\Himpunan;

class HimpunanService {

    public function store($data) {
        $himpunan = Himpunan::create([
            'variabel_id' => $data['variabel_id'],
            'nama' => $data['nama'],
            'domain' => json_encode($data['domain'])
        ]);

        return $himpunan;
    }

    public function update($data, $id)
    {
        $himpunan = Himpunan::findOrFail($id);

        $himpunan->update([
            'variabel_id' => $data['variabel_id'],
            'nama' => $data['nama'],
            'domain' => json_encode($data['domain'])
        ]);

        return $himpunan;
    }
}
