<?php

namespace App\Services;

class VariabelService
{
    public function store($data)
    {
        $variabel = \App\Models\Variabel::create([
            'nama' => $data['nama'],
            'kode' => $data['kode'],
            'keterangan' => $data['keterangan'],
        ]);

        return $variabel;
    }

    public function update($data, $id)
    {
        $variabel = \App\Models\Variabel::findOrFail($id);
        $variabel->update([
            'nama' => $data['nama'],
            'keterangan' => $data['keterangan'],
        ]);

        return $variabel;
    }
}
