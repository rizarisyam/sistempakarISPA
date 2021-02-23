<?php

namespace App\Services;

use App\Models\Keputusan;

class KeputusanService
{
    public function store($data)
    {
        $keputusan = \App\Models\Keputusan::create([
            'nama' => $data['nama'],
            'kode' => $data['kode'],
            'keterangan' => $data['keterangan'],
            'saran' => $data['saran'],
        ]);

        return $keputusan;
    }

    public function handleUpdate($data, $id)
    {
        $keputusan = Keputusan::findOrFail($id);
        $keputusan->update([
            'nama' => $data['nama'],
            'kode' => $data['kode'],
            'keterangan' => $data['keterangan'],
            'saran' => $data['saran'],
        ]);

        return $keputusan;
    }

    public function edit($id)
    {
        $keputusan = Keputusan::findOrFail($id);
        return $keputusan;
    }
}
